<?php

namespace App\Models\Activation;

use App\Models\User;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 * @method static truncate()
 * @method static when(bool $param, \Closure $param1)
 * @method static where(string $string, $ddHouse)
 * @method static whereIn()
 * @method static whereBetween(string $string, array $array)
 * @method static select(string $string)
 * @method static search(mixed $search)
 */
class HouseCodeActivation extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['user_id','retailer_code','activation','price','activation_date','flag','remarks'];
    protected array $searchable = ['retailer_code','activation','price','flag','remarks','user.name','user.rso.itop_number','user.bp.pool_number','user.cm.pool_number'];

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

    /**
     * Get current month price.
     *
     * @return mixed
     */
    public static function getPriceOfCurrentMonth(): mixed
    {
        $firstDayofCurrentMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofCurrentMonth = Carbon::now()->endOfMonth()->toDateString();

        return HouseCodeActivation::select('price')->groupBy('price')->whereBetween('activation_date', [$firstDayofCurrentMonth, $lastDayofCurrentMonth])->get();
    }

    /**
     * Get previous month price.
     *
     * @return mixed
     */
    public static function getPriceOfPreviousMonth(): mixed
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString();

        return HouseCodeActivation::select('price')->groupBy('price')->whereBetween('activation_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])->get();
    }

    /**
     * Get current month sum.
     *
     * @return mixed
     */
    public static function getSumOfCurrentMonth(): mixed
    {
        $firstDayofCurrentMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofCurrentMonth = Carbon::now()->endOfMonth()->toDateString();

        return HouseCodeActivation::whereBetween('activation_date', [$firstDayofCurrentMonth, $lastDayofCurrentMonth])->sum('activation');
    }

    /**
     * Get previous month sum.
     *
     * @return mixed
     */
    public static function getSumOfPreviousMonth(): mixed
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString();

        return HouseCodeActivation::whereBetween('activation_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])->sum('activation');
    }

    /**
     * Get current month activation by price.
     *
     * @param $price
     * @return mixed
     */
    public static function getActivationByPrice($price): mixed
    {
        $firstDayofCurrentMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofCurrentMonth = Carbon::now()->endOfMonth()->toDateString();
        return HouseCodeActivation::select('activation')->where('price', $price)->whereBetween('activation_date', [$firstDayofCurrentMonth, $lastDayofCurrentMonth])->sum('activation');
    }

    /**
     * Get previous month activation by price.
     *
     * @param $price
     * @return mixed
     */
    public static function getActivationByPreviousMonthPrice($price): mixed
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString();

        return HouseCodeActivation::select('activation')->where('price', $price)->whereBetween('activation_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])->sum('activation');
    }
}
