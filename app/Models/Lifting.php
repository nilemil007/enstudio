<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @method static create(array $lifting)
 * @method static where(string $string, string $string1, string $string2)
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
        'itopup',
        'total_amount',
        'lifting_date',
        'remarks',
    ];

    public function product(): Attribute
    {
        return Attribute::make(
            set: fn ($product) => Str::lower($product),
        );
    }
}
