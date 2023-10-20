<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activation\CoreActivation;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 * @method static firstWhere(string $column, mixed $value)
 * @method static whereNotNull()
 * @method static where(string $string)
 * @method static orderBy(string $string, string $string1)
 * @method static truncate()
 * @method static when(mixed $findByHouse, \Closure $param)
 * @method static findOrFail($id)
 */
class Rso extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dd_house_id',
        'user_id',
        'supervisor_id',
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

    // Search
//    public function scopeSearch( $query, $term )
//    {
//        $term = "%$term%";
//        $query->where( function ( $query ) use ( $term ){
//            $query->where( 'rso_code', 'like', $term )
//                ->orWhere( 'itop_number', 'like', $term )
//                ->orWhereHas('ddHouse', function ( $query ) use ( $term ){
//                    $query->where( 'id', 'like', $term );
//                });
//        });
//    }

    /**
     * Relationship.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    public function coreActivation(): HasMany
    {
        return $this->hasMany(CoreActivation::class);
    }

    public function kpiTarget(): HasOne
    {
        return $this->hasOne(KpiTarget::class);
    }

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo( DdHouse::class );
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo( Supervisor::class );
    }

    public function route(): BelongsToMany
    {
        return $this->belongsToMany( Route::class );
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
