<?php

namespace App\Models\Activation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
