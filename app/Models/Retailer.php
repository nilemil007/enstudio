<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Retailer extends Model
{
    use HasFactory;

    protected $fillable = [
        'dd_house',
        'user_id',
        'rso_id',
        'supervisor',
        'bts_code',
        'route',
        'retailer_code',
        'retailer_name',
        'tmp_retailer_name',
        'retailer_type',
        'tmp_retailer_type',
        'enabled',
        'sim_seller',
        'tmp_sim_seller',
        'itop_number',
        'service_point',
        'owner_name',
        'tmp_owner_name',
        'contact_no',
        'tmp_contact_no',
        'own_shop',
        'tmp_own_shop',
        'district',
        'thana',
        'tmp_thana',
        'address',
        'tmp_address',
        'nid',
        'tmp_nid',
        'trade_license_no',
        'tmp_trade_license_no',
        'others_operator',
        'tmp_others_operator',
        'longitude',
        'tmp_longitude',
        'latitude',
        'tmp_latitude',
        'device_name',
        'tmp_device_name',
        'device_sn',
        'tmp_device_sn',
        'scanner_sn',
        'tmp_scanner_sn',
        'document',
        'password',
        'status',
        'remarks',
    ];

    //_______________________________________Accessor________________________________________________

    /**
     * Set retailer name as formatted.
     *
     * @return Attribute
     */
    protected function retailerName(): Attribute
    {
        return Attribute::make(
            set: fn( $retailerName ) => Str::title( $retailerName ),
        );
    }

    /**
     * Set retailer type as formatted.
     *
     * @return Attribute
     */
    protected function retailerType(): Attribute
    {
        return Attribute::make(
            set: fn( $retailerType ) => Str::upper( $retailerType ),
        );
    }

    /**
     * Set owner name as formatted.
     *
     * @return Attribute
     */
    protected function ownerName(): Attribute
    {
        return Attribute::make(
            set: fn( $ownerName ) => Str::title( $ownerName ),
        );
    }

    /**
     * Set retailer address as formatted.
     *
     * @return Attribute
     */
    protected function address(): Attribute
    {
        return Attribute::make(
            set: fn( $address ) => Str::title( $address ),
        );
    }

    /**
     * Set device name as formatted.
     *
     * @return Attribute
     */
    protected function device_name(): Attribute
    {
        return Attribute::make(
            set: fn( $device_name ) => Str::title( $device_name ),
        );
    }

    /**
     * Set enabled as formatted.
     *
     * @return Attribute
     */
    protected function enabled(): Attribute
    {
        return Attribute::make(
            set: fn( $on ) => $on == 'N' ? 'N' : 'Y',
        );
    }

    /**
     * Set sim seller as formatted.
     *
     * @return Attribute
     */
    protected function simSeller(): Attribute
    {
        return Attribute::make(
            set: fn( $on ) => $on == 'N' ? 'N' : 'Y',
        );
    }

    /**
     * Set own shop as formatted.
     *
     * @return Attribute
     */
    protected function ownShop(): Attribute
    {
        return Attribute::make(
            set: fn( $on ) => $on == 'N' ? 'N' : 'Y',
        );
    }

    /**
     * Set others operator as formatted.
     *
     * @return Attribute
     */
    protected function othersOperator(): Attribute
    {
        return Attribute::make(
            get: fn( $othersOperator ) => json_decode( $othersOperator ),
            set: fn( $othersOperator ) => json_encode( $othersOperator ),
        );
    }
    //_______________________________________End Accessor___________________________________________


    //_______________________________________Relationship___________________________________________
//    public function user(): BelongsTo
//    {
//        return $this->belongsTo( User::class );
//    }
//
//    public function rso(): BelongsTo
//    {
//        return $this->belongsTo( Rso::class );
//    }
//
//    public function bts(): BelongsTo
//    {
//        return $this->belongsTo( Bts::class );
//    }
//
//    public function route(): BelongsTo
//    {
//        return $this->belongsTo( Route::class );
//    }
//
//    public function ddHouse(): BelongsTo
//    {
//        return $this->belongsTo( DdHouse::class );
//    }
//
//    public function c2s(): HasMany
//    {
//        return $this->hasMany( C2S::class );
//    }
//
//    public function simIssue(): HasMany
//    {
//        return $this->hasMany( SimIssue::class );
//    }
//    public function liveSimIssue(): HasMany
//    {
//        return $this->hasMany( LiveSimIssue::class );
//    }
//
//    public function balance(): HasMany
//    {
//        return $this->hasMany( Balance::class );
//    }
//
//    public function bso(): HasMany
//    {
//        return $this->hasMany( Bso::class );
//    }
//
//    public function dso(): HasMany
//    {
//        return $this->hasMany( Dso::class );
//    }
//
//    public function esaf(): HasMany
//    {
//        return $this->hasMany( Esaf::class );
//    }
}
