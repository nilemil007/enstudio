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
 * @method static firstWhere(string $string, mixed $product)
 */
class ProductAndType extends Model
{
    use HasFactory;

    protected $fillable = ['product_type','product','price','lifting_price','retailer_price'];

    public function productType(): Attribute
    {
        return Attribute::make(
            set: fn($type) => Str::lower($type),
        );
    }

    public function product(): Attribute
    {
        return Attribute::make(
            get: fn($product) => Str::upper($product),
            set: fn($product) => implode('_', explode(' ', Str::lower($product))),
        );
    }

    public static function getProductData($product)
    {
        return ProductAndType::firstWhere('product', $product);
    }
}
