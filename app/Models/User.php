<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Activation\HouseCodeActivation;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static where(string $string, mixed $login)
 * @method static latest()
 * @method static create(mixed $user)
 * @method static truncate()
 * @method static firstWhere()
 * @method static whereHas(string $string, \Closure $param)
 * @property mixed $image
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dd_house',
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
     * User has one retailer.
     *
     * @return HasMany
     */
    public function houseCodeActivation(): HasMany
    {
        return $this->hasMany( HouseCodeActivation::class );
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


}
