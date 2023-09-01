<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static where(string $string, int|string|null $id)
 * @method static get()
 * @method static updateOrCreate(array $array, array $array1)
 * @method static firstWhere(string $string, int|string|null $id)
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shera_partner_percentage',
        'shera_partner_day',
        'drc_code',
        'exclude_from_rso_act',
        'exclude_from_live_act',
        'product_code',
        'dd_house'
    ];

    public function productCode(): Attribute
    {
        return Attribute::make(
            get: fn($productCode) => json_decode($productCode),
            set: fn($productCode) => json_encode($productCode),
        );
    }

    public function ddHouse(): Attribute
    {
        return Attribute::make(
            get: fn($ddHouse) => json_decode($ddHouse),
            set: fn($ddHouse) => json_encode($ddHouse),
        );
    }

    public static function getDrcCode(): array
    {
        foreach(Setting::get() as $setting)
        {
            return Retailer::whereIn('code', explode(',', $setting->drc_code))->pluck('id')->toArray();
        }
    }
}
