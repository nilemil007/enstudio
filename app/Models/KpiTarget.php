<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function getTotalTargetByHouse($house)
    {
        $id = DdHouse::whereIn('code', $house)->pluck('id');
        return KpiTarget::whereIn('dd_house_id', $id)->sum('ga');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ddHouse()
    {
        return $this->belongsTo(DdHouse::class);
    }

    public function rso()
    {
        return $this->belongsTo(Rso::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
}
