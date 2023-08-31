<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @method static whereIn(string $string, $pluck)
 */
class KpiTarget extends Model
{
    use HasFactory;

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

    public static function getTotalTargetByHouse()
    {
        $setting = Setting::where('user_id', Auth::id())->first();

        return KpiTarget::whereIn('dd_house_id', DdHouse::whereIn('id', $setting->dd_house)->pluck('id'))->sum('ga');
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
