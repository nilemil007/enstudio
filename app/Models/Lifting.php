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
 */
class Lifting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dd_house_id',
        'product_type',
        'product',
        'qty',
        'price',
        'lifting_price',
        'product_lifting_price',
        'itopup',
        'total_amount',
        'lifting_date',
        'remarks',
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

    public static function getLiftingData($house, $product)
    {
        return Lifting::where(['dd_house_id' => $house, 'product' => $product])->whereDate('lifting_date', now())->first();
    }
}
