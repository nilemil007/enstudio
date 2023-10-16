<?php

namespace App\Models;

use App\Models\Activation\CoreActivation;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * @method static create()
 * @method static firstWhere()
 * @method static where(string $string, $ddCode)
 * @method static whereNotIn($tcrcId)
 * @method static whereIn(string $string, $retId)
 * @method static truncate()
 * @method static select(string $string)
 * @method static groupBy(string $string)
 * @method static paginate(int $int)
 * @method static whereBetween(string $string, array $array)
 */
class Retailer extends Model
{
    use HasFactory;

    protected $fillable = [
        'dd_house_id',
        'user_id',
        'rso_id',
        'supervisor_id',
        'bts_id',
        'route_id',
        'code',
        'name',
        'tmp_name',
        'type',
        'tmp_type',
        'category',
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
        'blood_group',
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
        'password',
        'nid',
        'tmp_nid',
        'nid_upload',
        'status',
        'remarks',
    ];

    //_______________________________________Accessor________________________________________________
    /**
     * Show retailer nid or default image.
     *
     * @return Attribute
     */
    protected function nidUpload(): Attribute
    {
        return Attribute::make(
            get: fn ( $nid ) => empty( $nid ) ? url('assets/images/default-nid.jpg') : url('assets/images/nid/retailer/') . $nid,
        );
    }

    /**
     * Set retailer name as formatted.
     *
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn( $name ) => Str::title( $name ),
        );
    }

    /**
     * Set retailer type as formatted.
     *
     * @return Attribute
     */
    protected function type(): Attribute
    {
        return Attribute::make(
            set: fn( $type ) => Str::upper( $type ),
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
    protected function deviceName(): Attribute
    {
        return Attribute::make(
            set: fn( $deviceName ) => Str::title( $deviceName ),
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

    /**
     * Retailer belongs to a dd house.
     *
     * @return BelongsTo
     */
    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo( DdHouse::class );
    }

    /**
     * Retailer belongs to a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    /**
     * Retailer has one TCRC.
     *
     * @return HasOne
     */
    public function tradeCampaignRetailerCode(): HasOne
    {
        return $this->hasOne( TradeCampaignRetailerCode::class );
    }

    /**
     * Retailer has one core activation.
     *
     * @return HasMany
     */
    public function coreActivation(): HasMany
    {
        return $this->hasMany( CoreActivation::class );
    }
}
