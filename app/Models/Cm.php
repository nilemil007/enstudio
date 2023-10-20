<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
class Cm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dd_house_id',          // Required
        'user_id',              // Nullable
        'name',                 // Required
        'designation',          // Nullable
        'type',                 // Nullable
        'pool_number',          // Required | Unique
        'personal_number',      // Nullable | Unique
        'tmp_personal_number',  // Nullable | Unique
        'nid_number',           // Nullable | Unique
        'tmp_nid_number',       // Nullable | Unique
        'father_name',          // Nullable
        'tmp_father_name',      // Nullable
        'mother_name',          // Nullable
        'tmp_mother_name',      // Nullable
        'division',             // Nullable
        'tmp_division',         // Nullable
        'district',             // Nullable
        'tmp_district',         // Nullable
        'thana',                // Nullable
        'tmp_thana',            // Nullable
        'address',              // Nullable
        'tmp_address',          // Nullable
        'bank_account_name',    // Nullable
        'bank_name',            // Nullable
        'tmp_bank_name',        // Nullable
        'account_number',       // Nullable | Unique
        'tmp_account_number',   // Nullable | Unique
        'account_type',         // Nullable
        'tmp_account_type',     // Nullable
        'branch_name',          // Nullable
        'tmp_branch_name',      // Nullable
        'salary',               // Nullable
        'education',            // Nullable
        'gender',               // Nullable
        'blood_group',          // Nullable
        'dob',                  // Nullable
        'tmp_dob',              // Nullable
        'joining_date',         // Nullable
        'resigning_date',       // Nullable
        'documents',            // Nullable
        'status',               // Default '1'
        'remarks',              // Nullable
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

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo( DdHouse::class );
    }
}
