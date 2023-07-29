<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 * @method static whereNotNull(string $string)
 */
class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'dd_house',
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
        'joining_date' => 'datetime',
        'resigning_date' => 'datetime',
        'dob' => 'datetime',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
