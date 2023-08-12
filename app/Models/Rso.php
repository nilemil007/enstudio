<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 * @method static firstWhere()
 * @method static whereNotNull()
 * @method static where(string $string)
 * @method static orderBy(string $string, string $string1)
 * @method static truncate()
 */
class Rso extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nominee_id',
        'supervisor',
        'dd_house',
        'routes',
        'rso_code',
        'itop_number',
        'pool_number',
        'personal_number',
        'tmp_personal_number',
        'rid',
        'father_name',
        'tmp_father_name',
        'mother_name',
        'tmp_mother_name',
        'division',
        'district',
        'thana',
        'address',
        'tmp_address',
        'blood_group',
        'tmp_blood_group',
        'sr_no',
        'account_number',
        'tmp_account_number',
        'bank_name',
        'tmp_bank_name',
        'brunch_name',
        'tmp_brunch_name',
        'routing_number',
        'tmp_routing_number',
        'salary',
        'education',
        'tmp_education',
        'marital_status',
        'tmp_marital_status',
        'gender',
        'dob',
        'tmp_dob',
        'nid',
        'tmp_nid',
        'status',
        'remarks',
        'document',
        'residential_rso',
        'joining_date',
        'resigning_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dob'               => 'datetime',
        'tmp_dob'           => 'datetime',
        'joining_date'      => 'datetime',
        'resigning_date'    => 'datetime',
    ];

    /**
     * Relationship.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    /**
     * Set string data into route.
     * Get array data.
     *
     * @return Attribute
     */
    protected function routes(): Attribute
    {
        return Attribute::make(
            get: fn($route) => explode(',', $route),
            set: fn($route) => implode(',', $route),
        );
    }

    /**
     * Get uc first.
     * Set lower.
     *
     * @return Attribute
     */
    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn($gender) => Str::title($gender),
            set: fn($gender) => Str::lower($gender),
        );
    }
}
