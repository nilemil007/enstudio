<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @method static create(array $lifting)
 * @method static where(string $string, string $string1, string $string2)
 * @method static whereDate(string $string, \Illuminate\Support\Carbon $now)
 * @method static groupBy(string $string)
 * @method static select(string $string)
 * @method static firstWhere(string $string, $dd_house_id)
 * @method static whereIn()
 */
class Lifting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dd_house_id',
        'mmst',
        'mmst_lifting_price',
        'mmst_amount',
        'mmst_remarks',
        'mmsts',
        'mmsts_lifting_price',
        'mmsts_amount',
        'mmsts_remarks',
        'sim_swap',
        'sim_swap_lifting_price',
        'sim_swap_amount',
        'sim_swap_remarks',
        'sim_swap_ev',
        'sim_swap_ev_lifting_price',
        'sim_swap_ev_amount',
        'sim_swap_ev_remarks',
        'total_sim_amount',
        'sc_10',
        'sc_10_lifting_price',
        'sc_10_amount',
        'sc_10_lifting_amount',
        'sc_10_remarks',
        'sc_14',
        'sc_14_lifting_price',
        'sc_14_amount',
        'sc_14_lifting_amount',
        'sc_14_remarks',
        'scd_14',
        'scd_14_lifting_price',
        'scd_14_amount',
        'scd_14_lifting_amount',
        'scd_14_remarks',
        'sc_19',
        'sc_19_lifting_price',
        'sc_19_amount',
        'sc_19_lifting_amount',
        'sc_19_remarks',
        'scd_19',
        'scd_19_lifting_price',
        'scd_19_amount',
        'scd_19_lifting_amount',
        'scd_19_remarks',
        'sc_20',
        'sc_20_lifting_price',
        'sc_20_amount',
        'sc_20_lifting_amount',
        'sc_20_remarks',
        'scd_29',
        'scd_29_lifting_price',
        'scd_29_amount',
        'scd_29_lifting_amount',
        'scd_29_remarks',
        'total_sc_amount',
        'total_sc_lifting_amount',
        'router',
        'router_price',
        'router_lifting_price',
        'router_amount',
        'router_lifting_amount',
        'router_remarks',
        'total_device_amount',
        'total_device_lifting_amount',
        'itopup',
        'itopup_remarks',
        'bank_deposit',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'lifting_date' => 'datetime',
    ];

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }

    public function product(): Attribute
    {
        return Attribute::make(
            set: fn ($product) => Str::lower($product),
        );
    }
}
