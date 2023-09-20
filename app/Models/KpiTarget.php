<?php

namespace App\Models;

use App\Http\Traits\Settings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @method static whereIn(string $string, $pluck)
 * @method static where(string $string, $ddHouseId)
 * @method static get()
 * @method static paginate(int $int)
 */
class KpiTarget extends Model
{
    use HasFactory, Settings;

    protected $fillable = [
        'user_id',
        'dd_house_id',
        'rso_id',
        'supervisor_id',
        'ga',
        'recharge',
        'data',
        'mixed',
        'voice',
        'total_bundle',
        'lso',
        'sso',
        'bso',
        'dsso',
        'ddso',
        'dso',
    ];

    public static function getTotalTarget( $id, $startDate, $endDate )
    {
        return KpiTarget::where('dd_house_id', $id)->whereBetween('created_at', [$startDate, $endDate])->sum('ga');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }

    public function rso(): BelongsTo
    {
        return $this->belongsTo(Rso::class);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class);
    }
}
