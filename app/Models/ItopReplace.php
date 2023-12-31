<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

/**
 * @method static create(mixed $replace)
 * @method static truncate()
 */
class ItopReplace extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'itop_number',
        'tmp_itop_number',
        'serial_number',
        'balance',
        'reason',
        'description',
        'pay_amount',
        'remarks',
        'status',
        'payment_at'
    ];

    protected $casts = [
        'payment_at' => 'datetime',
    ];

    // Search
    public function scopeSearch( $query, $term ): void
    {
        $term = "%$term%";
        $query->where( function ( $query ) use ( $term ){
            $query->where( 'itop_number', 'like', $term )
                ->orWhere( 'serial_number', 'like', $term )
                ->orWhere( 'balance', 'like', $term )
                ->orWhere( 'reason', 'like', $term )
                ->orWhere( 'description', 'like', $term )
                ->orWhere( 'pay_amount', 'like', $term )
                ->orWhere( 'remarks', 'like', $term )
                ->orWhere( 'status', 'like', $term )
                ->orWhereHas('user', function ( $query ) use ( $term ){
                    $query->where( 'name', 'like', $term )
                        ->orWhere( 'role', 'like', $term );
                });
        });
    }

    // Relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }
}
