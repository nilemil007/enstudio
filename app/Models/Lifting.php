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
 */
class Lifting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dd_house_id',
        'details',
        'lifting_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'lifting_date' => 'datetime',
        'details' => 'array',
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
