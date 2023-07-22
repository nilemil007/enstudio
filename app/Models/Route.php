<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 */
class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'dd_house_id',
        'code',
        'name',
        'description',
        'length',
        'weekdays',
        'status',
    ];
}
