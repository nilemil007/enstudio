<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','shera_partner_percentage','shera_partner_day','drc_code','exclude_from_core_act','exclude_from_live_act'];
}
