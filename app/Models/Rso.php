<?php

namespace App\Models;

use App\Exports\RetailersExport;
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
        'sr_no',
        'residential_rso',
        'date',
        'rid',
        'name',
        'father_name',
        'mother_name',
        'division',
        'district',
        'thana',
        'present_address',
        'permanent_address',
        'witness_name',
        'witness_number',
        'salary',
        'employee_signature',
        'personal_number',
        'dob',
        'nid',
        'blood_group',
        'marital_status',
        'nationality',
        'religion',
        'gender',
        'place_of_birth',
        'rso_image',
        'education',
        'serial_number',
        'dbjsc',
        'dbcsc',
        'dbchc',
        'mbcd',
        'student_id',
        'registration_no',
        'board',
        'session',
        'examination',
        'institute_name',
        'certificate_thana',
        'roll_no',
        'subject',
        'edu_division',
        'gpa',
        'dob_in_reg_card',
        'month_of',
        'issue_date',
        'publish_date',
        'bank_name',
        'brunch_name',
        'routing_number',
        'account_number',
        'nominee_name',
        'nominee_relation',
        'nominee_contact_no',
        'nominee_address',
        'rso_name_bangla',
        'nominee_dob',
        'nominee_nid',
        'nominee_image',
        'nominee_signature',
        'nominee_witness_name',
        'nominee_witness_designation',
        'nominee_witness_signature',
        'status',
        'remarks',
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

    public function coreActivation(): HasMany
    {
        return $this->hasMany(CoreActivation::class);
    }

    public function retailer(): HasMany
    {
        return $this->hasMany(Retailer::class);
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
     * Get gender name in upper case first.
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
