<?php

namespace App\Models\Activation;

use App\Models\DdHouse;
use App\Models\Retailer;
use App\Models\Rso;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static whereNotNull(string $string)
 * @method static where(string $string, $date)
 * @method static whereIn(string $string, string[] $array)
 */
class CoreActivation extends Model
{
    use HasFactory;

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

    public static function getRetailerTotalActivaton($id)
    {
        return CoreActivation::whereIn('product_code',['MMST','MMSTS'])
        ->where('retailer_id', $id)
        ->count('retailer_id');
    }

    public static function getTotalActivatonByHouse($house)
    {
        $id = DdHouse::whereIn('code', $house)->pluck('id');
        return CoreActivation::whereIn('product_code',['MMST','MMSTS'])->whereIn('dd_house_id', $id)->count('retailer_id');
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