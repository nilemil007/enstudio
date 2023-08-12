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
 * @method static when(bool $param, \Closure $param1)
 * @method static where(string $string, $ddHouse)
 * @method static whereIn()
 * @method static whereBetween(string $string, array $array)
 * @method static select(string $string)
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
     * User has one retailer.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    public static function getPrice()
    {
        return HouseCodeActivation::select('price')->groupBy('price')->get();
    }

    public static function getActivationByPrice($price)
    {
        return HouseCodeActivation::select('activation')->where('price', $price)->sum('activation');
    }
}
