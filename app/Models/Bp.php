<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(mixed $data)
 * @method static latest()
 * @method static whereNotNull(string $string)
 * @method static truncate()
 * @method static orderBy(string $string, string $string1)
 * @property mixed documents
 */
class Bp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dd_house_id',
        'supervisor_id',
        'response_id',
        'type',
        'pool_number',
        'personal_number',
        'tmp_personal_number',
        'gender',
        'blood_group',
        'tmp_blood_group',
        'education',
        'tmp_education',
        'father_name',
        'tmp_father_name',
        'mother_name',
        'tmp_mother_name',
        'division',
        'tmp_division',
        'district',
        'tmp_district',
        'thana',
        'tmp_thana',
        'address',
        'tmp_address',
        'nid',
        'tmp_nid',
        'bank_name',
        'tmp_bank_name',
        'brunch_name',
        'tmp_brunch_name',
        'salary',
        'account_number',
        'tmp_account_number',
        'documents',
        'dob',
        'tmp_dob',
        'joining_date',
        'resigning_date',
        'status',
        'remarks',
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

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
