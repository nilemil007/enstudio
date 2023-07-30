<?php

namespace App\Models\Activation;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 * @method static truncate()
 */
class HouseCodeActivation extends Model
{
    use HasFactory;

    protected $fillable = ['dd_house','user_id','retailer_code','activation','price','activation_date'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = ['activation_date' => 'datetime'];

    /**
     * House Code Activation Summary Search Report.
     *
     * @param Builder $query
     * @param $term
     * @return void
     */
    public function scopeSearch(Builder $query, $term ): void
    {
        $term = "%$term%";
        $query->where( function ( $query ) use ( $term ){
            $query->where( 'activation_date', 'like', $term );
        });
    }

    /**
     * User has one retailer.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }
}
