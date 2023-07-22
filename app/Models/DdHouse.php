<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static truncate()
 * @method static latest()
 * @method static create(mixed $house)
 * @method static firstWhere(string $string, $ddCode)
 */
class DdHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'cluster_name',
        'region',
        'name',
        'email',
        'district',
        'address',
        'proprietor_name',
        'proprietor_number',
        'poc_name',
        'poc_number',
        'tin_number',
        'bin_number',
        'latitude',
        'longitude',
        'bts_code',
        'image',
        'lifting_date',
        'status',
    ];

    public function route(): HasMany
    {
        return $this->hasMany(Route::class);
    }
}
