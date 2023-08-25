<?php

namespace App\Models;

use App\Models\Activation\CoreActivation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 * @method static whereNotNull(string $string)
 * @method static firstWhere(string $string, int|string|null $id)
 * @method static where(string $string, $house_code)
 */
class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'dd_house_id',
        'user_id',
        'pool_number',
        'father_name',
        'mother_name',
        'division',
        'district',
        'thana',
        'address',
        'nid',
        'dob',
        'joining_date',
        'resigning_date',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'joining_date'      => 'datetime',
        'resigning_date'    => 'datetime',
        'dob'               => 'datetime',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }

    public function coreActivation(): HasMany
    {
        return $this->hasMany(CoreActivation::class);
    }

    public function rso(): HasMany
    {
        return $this->hasMany(Rso::class);
    }

}
