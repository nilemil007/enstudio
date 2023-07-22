<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 */
class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'dd_house_id',
        'code',
        'name',
        'description',
        'length',
        'weekdays',
        'status',
    ];

    /**
     * Relationship
     */
    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }

    protected function ddHouseId(): Attribute
    {
        return Attribute::make(
            set: fn ($ddCode) => DdHouse::firstWhere('code', $ddCode)->id,
        );
    }
}
