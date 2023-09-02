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
        'main_house_osdo_residential_rso',
        'thana',
        'sran_rso',
        'sran_site_count',
        'remarks',
    ];

    public static function getTotalTargetByHouse($id)
    {
        $ddHouseId = DdHouse::firstWhere('id', $id)->id;
        return KpiTarget::where('dd_house_id', $ddHouseId)->sum('ga');
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
