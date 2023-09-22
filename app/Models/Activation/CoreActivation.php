<?php

namespace App\Models\Activation;

use App\Http\Traits\Settings;
use App\Models\DdHouse;
use App\Models\Retailer;
use App\Models\Rso;
use App\Models\Setting;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @method static whereNotNull(string $string)
 * @method static where(string $string, $date)
 * @method static whereIn(string $string, string[] $array)
 * @method static paginate(int $int)
 */
class CoreActivation extends Model
{
    use HasFactory, Settings;

    protected $fillable = [
        'dd_house_id',
        'supervisor_id',
        'rso_id',
        'retailer_id',
        'product_code',
        'product_name',
        'sim_serial',
        'msisdn',
        'bp_flag',
        'bp_number',
        'selling_price',
        'activation_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'activation_date' => 'datetime',
    ];

    public static function getRetailerActivationByDate($retailerId, $date)
    {
        return CoreActivation::where('activation_date', $date)
        ->whereIn('product_code',['MMST','MMSTS'])
        ->where('retailer_id', $retailerId)
        ->count('retailer_id');
    }

    public static function getRetailerTotalActivation($id) //getRetailerTotalActivaton
    {
        return CoreActivation::whereIn('product_code',['MMST','MMSTS'])
        ->where('retailer_id', $id)
        ->count('retailer_id');
    }

    public static function getTotalActivation( $id, $startDate, $endDate )
    {
        dd(Setting::getDrcCode());
        $drc = !empty(CoreActivation::getSettings()->drc_code) && !empty(CoreActivation::getSettings()->exclude_from_rso_act) ? Setting::getDrcCode() : [];

        return CoreActivation::whereIn('product_code', CoreActivation::getSettings()->product_code ?? [])
            ->where('dd_house_id', $id)
            ->whereBetween('activation_date', [$startDate, $endDate])
            ->whereNotIn('retailer_id', $drc)
            ->count('retailer_id');
    }

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class);
    }
    public function rso(): BelongsTo
    {
        return $this->belongsTo(Rso::class);
    }
    public function retailer(): BelongsTo
    {
        return $this->belongsTo(Retailer::class);
    }
}
