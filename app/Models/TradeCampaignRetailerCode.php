<?php

namespace App\Models;

use App\Traits\Searchable;
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
 * @method static firstWhere(string $string, $id)
 * @method static where(string $column, string $operator, mixed $value)
 */
class TradeCampaignRetailerCode extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = ['user_id','retailer_code','flag','remarks'];
    protected array $searchable = ['retailer_code','flag','remarks','user.name','user.rso.itop_number','user.bp.pool_number','user.cm.pool_number'];

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
