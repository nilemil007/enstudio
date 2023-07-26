<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 */
class Bts extends Model
{
    use HasFactory;

    protected $fillable = [
        'dd_house',
        'site_id',
        'bts_code',
        'division',
        'district',
        'thana',
        'address',
        'network_mode',
        'longitude',
        'latitude',
        'two_g_on_air_date',
        'three_g_on_air_date',
        'four_g_on_air_date',
        'urban_rural',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'two_g_on_air_date'     => 'datetime',
        'three_g_on_air_date'   => 'datetime',
        'four_g_on_air_date'    => 'datetime',
    ];
}
