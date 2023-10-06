<?php

namespace App\Models;

use App\Models\Activation\CoreActivation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static truncate()
 * @method static latest()
 * @method static create(mixed $house)
 * @method static firstWhere(string $string, $ddCode)
 * @method static whereIn(string $string, $house)
 * @method static get()
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

    public function bp(): HasMany
    {
        return $this->hasMany(Bp::class);
    }

    public function supervisor(): HasMany
    {
        return $this->hasMany(Supervisor::class);
    }

    public function rso(): HasMany
    {
        return $this->hasMany(Rso::class);
    }

    public function retailer(): HasMany
    {
        return $this->hasMany(Retailer::class);
    }

    public function scSerial(): HasMany
    {
        return $this->hasMany(ScratchCardSerial::class);
    }

    public function coreActivation(): HasMany
    {
        return $this->hasMany(CoreActivation::class);
    }

    public function kpiTarget(): HasMany
    {
        return $this->hasMany(KpiTarget::class);
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
