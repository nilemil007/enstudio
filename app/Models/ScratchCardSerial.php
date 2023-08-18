<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static truncate()
 * @method static create(array $array)
 */
class ScratchCardSerial extends Model
{
    use HasFactory;

    protected $fillable = ['dd_house_id','product_code','serial','group','status'];

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }
}
