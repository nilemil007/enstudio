<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(int $i)
 */
class ScratchCardSerial extends Model
{
    use HasFactory;

    protected $fillable = ['serial','status'];

//    public static function generateSequesce($firstSerial, $lastSerial)
//    {
//        for ($i = $firstSerial; $i <= $lastSerial; $i++)
//        {
//            print_r($i);
//        }
//    }
}
