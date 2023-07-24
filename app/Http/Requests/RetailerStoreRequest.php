<?php

namespace App\Http\Requests;

use App\Rules\Nid;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $image
 * @property mixed $nid_upload
 */
class RetailerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id'           => ['nullable'],
            'dd_house'          => ['required'],
            'rso_id'            => ['required'],
            'supervisor'        => ['required'],
            'bts_code'          => ['nullable'],
            'route'             => ['required'],
            'code'              => ['required'],
            'name'              => ['required'],
            'type'              => ['required'],
            'enabled'           => ['required'],
            'sim_seller'        => ['required'],
            'itop_number'       => ['required'],
            'service_point'     => ['required'],
            'owner_name'        => ['required'],
            'contact_no'        => ['required'],
            'own_shop'          => ['required'],
            'district'          => ['required'],
            'thana'             => ['required'],
            'address'           => ['required'],
            'blood_group'       => ['required'],
            'trade_license_no'  => ['nullable'],
            'others_operator'   => ['nullable'],
            'longitude'         => ['nullable'],
            'latitude'          => ['nullable'],
            'device_name'       => ['nullable'],
            'device_sn'         => ['nullable'],
            'scanner_sn'        => ['nullable'],
            'password'          => ['nullable'],
            'house_code'        => ['nullable'],
            'nid'               => ['required', new Nid],
            'image'             => ['nullable','image'],
            'nid_upload'        => ['nullable','image'],
        ];
    }
}
