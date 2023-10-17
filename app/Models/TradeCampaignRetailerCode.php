<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $only)
 * @method static whereNotNull(string $string)
 * @method static whereIn(string $string, $retId)
 * @method static latest()
 * @method static truncate()
 * @method static whereBetween(string $string, array $array)
 */
class TradeCampaignRetailerCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','retailer_code','flag','remarks'];

    /**
     * TCRC belongs to a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }
}
