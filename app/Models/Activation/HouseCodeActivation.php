<?php

namespace App\Models\Activation;

use App\Models\Bp;
use App\Models\Cm;
use App\Models\Rso;
use App\Models\User;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Exception;

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
 * @method static whereNotNull(string $string)
 */
class HouseCodeActivation extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['user_id','retailer_code','activation','price','activation_date','flag','remarks'];
    protected array $searchable = ['retailer_code','activation','price','flag','remarks','user.name','user.rso.itop_number','user.bp.pool_number','user.cm.pool_number'];
    protected array $filterable = ['retailer_code','activation'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = ['activation_date' => 'datetime'];

    /**
     * Filter house code activation data.
     *
     */
    public function scopeFilter($query, array $terms = null)
    {
//        $id = Bp::firstWhere('pool_number', $terms['user'])->id;
//        dd();
        $query->orWhere(function ($query) use ($terms){
            $query->when($terms['user'], function ($query) use ($terms){
                $role = null;
                $bpId = !empty(Bp::firstWhere('pool_number', $terms['user'])->id) ? Bp::firstWhere('pool_number', $terms['user'])->id : null;
                $cmId = !empty(Cm::firstWhere('pool_number', $terms['user'])->id) ? Cm::firstWhere('pool_number', $terms['user'])->id : null;
                $rsoId = !empty(Rso::firstWhere('itop_number', $terms['user'])->id) ? Rso::firstWhere('itop_number', $terms['user'])->id : null;
//                dd(!empty($bpId));
                if (!empty($bpId))
                {
                    $role = Bp::findOrFail($bpId)->user->role;
                }elseif (!empty($rsoId))
                {
                    $role = Rso::findOrFail($rsoId)->user->role;
                }elseif (!empty($cmId))
                {
                    $role = Cm::findOrFail($rsoId)->user->role;
                }

                switch ($role)
                {
                    case ('bp'):
                        dd('bp');
//                        $query->whereHas('user', function ($query) use ($terms){
//                            $query->withWhereHas('bp', function ($query) use ($terms){
//                                $query->where('pool_number', 'LIKE', $terms['user']);
//                            });
//                        });
                        break;
                    case ('rso'):
                        dd('rso');
//                        $query->whereHas('user', function ($query) use ($terms){
//                            $query->withWhereHas('rso', function ($query) use ($terms){
//                                $query->where('itop_number', 'LIKE', $terms['user']);
//                            });
//                        });
                        break;
                    case ('cm'):
                        dd('cm');
                        break;
                }
            });


//            $query->when($terms['user'], function ($query) use ($terms){
//                $query->whereHas('user', function ($query) use ($terms){
//                    $query->withWhereHas('bp', function ($query) use ($terms){
//                        $query->where('pool_number', 'LIKE', $terms['user']);
//                    });
//                });
//            });

//            $query->when($terms['user'], function ($query) use ($terms){
//                $query->whereHas('user', function ($query) use ($terms){
//                    $query->withWhereHas('rso', function ($query) use ($terms){
//                        $query->where('itop_number', 'LIKE', $terms['user']);
//                    });
//                });
//            });

            $query->when($terms['retailer_code'], function ($query) use ($terms){
                $query->where('retailer_code','LIKE',$terms['retailer_code']);
            });

            $query->when($terms['activation'], function ($query) use ($terms){
                $query->where('activation','LIKE',$terms['activation']);
            });

            $query->when($terms['price'], function ($query) use ($terms){
                $query->where('price','LIKE',$terms['price']);
            });

            $query->when($terms['flag'], function ($query) use ($terms){
                $query->where('flag','LIKE',$terms['flag']);
            });

            $query->when($terms['remarks'], function ($query) use ($terms){
                $query->where('remarks','LIKE',$terms['remarks']);
            });

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
