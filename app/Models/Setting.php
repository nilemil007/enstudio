<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','shera_partner_percentage','shera_partner_day','drc_code','exclude_from_core_act','exclude_from_live_act'];

    public static function getDrc()
    {
        foreach(Setting::get() as $setting)
        {
            return Retailer::whereIn('code', explode(',', $setting->drc_code))->pluck('id')->toArray();
        }
    }
}
