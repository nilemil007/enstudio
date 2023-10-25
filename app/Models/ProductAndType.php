<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static create(array $data)
 */
class ProductAndType extends Model
{
    use HasFactory;

    protected $fillable = ['product_type','product'];

    public function productType(): Attribute
    {
        return Attribute::make(
            get: fn($type) => Str::upper($type),
            set: fn($type) => Str::lower($type),
        );
    }

    public function product(): Attribute
    {
        return Attribute::make(
            get: fn($product) => Str::upper($product),
            set: fn($product) => Str::lower($product),
        );
    }
}
