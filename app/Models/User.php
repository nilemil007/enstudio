<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Activation\HouseCodeActivation;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static where(string $column, string $operator, mixed $mixed = null)
 * @method static latest()
 * @method static create(mixed $user)
 * @method static truncate()
 * @method static firstWhere(string $column, string $value)
 * @method static whereHas(string $string, \Closure $param)
 * @method static whereIn(string $string, $userId)
 * @method static whereNotIn(string $string, $userId)
 * @method static orderBy(string $string, string $string1)
 * @method static findOrFail($id)
 * @property mixed $image
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'role',
        'password',
        'image',
        'status',
    ];

    /**
     * Searchable column's.
     *
     * @var array<int, string>
     */
    protected array $searchable = [
        'name',
        'username',
        'phone',
        'email',
        'role',
        'ddHouse.code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Show user image or default image.
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ( $image ) => empty( $image ) ?  url('public/assets/images/avatar.png') : url('public/assets/images/users/' . $image),
        );
    }

    /**
     * Set username without any space.
     *
     * @return Attribute
     */
    protected function username(): Attribute
    {
        return Attribute::make(
            set: fn ( $username ) => preg_replace('/[^a-zA-Z0-9_ -]/s','', str_replace(['\'', '"', ',', ';', '<', '>', '/', ' '], '', Str::lower($username))),
        );
    }

    /**
     * Relationship with supervisor.
     *
     * @return HasOne
     */
    public function supervisor(): HasOne
    {
        return $this->hasOne( Supervisor::class );
    }

    /**
     * Relationship with rso.
     *
     * @return HasOne
     */
    public function rso(): HasOne
    {
        return $this->hasOne( Rso::class );
    }

    /**
     * User has one retailer.
     *
     * @return HasOne
     */
    public function retailer(): HasOne
    {
        return $this->hasOne( Retailer::class );
    }

    /**
     * User has many retailer.
     *
     * @return HasMany
     */
    public function houseCodeActivation(): HasMany
    {
        return $this->hasMany( HouseCodeActivation::class );
    }

    /**
     * User has many TCRC.
     *
     * @return HasMany
     */
    public function tradeCampaignRetailerCode(): HasMany
    {
        return $this->hasMany( TradeCampaignRetailerCode::class );
    }

    /**
     * User has many kpi target.
     *
     * @return HasMany
     */
    public function kpiTarget(): HasMany
    {
        return $this->hasMany( KpiTarget::class );
    }

    /**
     * User has one bp.
     *
     * @return HasOne
     */
    public function bp(): HasOne
    {
        return $this->hasOne( Bp::class );
    }

    /**
     * User has one cm.
     *
     * @return HasOne
     */
    public function cm(): HasOne
    {
        return $this->hasOne( Cm::class );
    }

    /**
     * User has one bp.
     *
     * @return BelongsToMany
     */
    public function ddHouse(): BelongsToMany
    {
        return $this->belongsToMany( DdHouse::class );
    }
}
