<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static create(array $data)
 * @method static latest()
 * @method static select(string $string)
 * @method static where(string $string, $type)
 */
class ProductAndType extends Model
{
    use HasFactory;

    protected $fillable = ['product_type','product','lifting_price','retailer_price'];

    public function productType(): Attribute
    {
        return Attribute::make(
            set: fn($type) => Str::lower($type),
        );
    }

    public function product(): Attribute
    {
        return Attribute::make(
            set: fn($product) => Str::lower($product),
        );
    }
}
