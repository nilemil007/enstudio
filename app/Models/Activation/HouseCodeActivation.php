<?php

namespace App\Models\Activation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 */
class HouseCodeActivation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','retailer_code','activation','price','activation_date'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = ['activation_date' => 'datetime'];
}
