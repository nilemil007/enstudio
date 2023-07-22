<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static where(string $string, mixed $login)
 * @method static latest()
 * @method static create(mixed $user)
 * @method static truncate()
 * @property mixed $image
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected string $uploads = 'storage/users/';

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
            get: fn ( $image ) => empty( $image ) ? asset('assets/images/avatar.png') : $this->uploads . $image,
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


}
