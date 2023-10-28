<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lifting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dd_house_id',
        'product_type',
        'product',
        'qty',
        'price',
        'itopup',
        'total_amount',
        'lifting_date',
    ];
}