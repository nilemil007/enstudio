<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    use HasFactory;

    protected $fillable = ['retailer_id','flag','status'];

    /**
     * Retailer belongs to a user.
     *
     * @return BelongsTo
     */
    public function retailer(): BelongsTo
    {
        return $this->belongsTo( Retailer::class );
    }
}
