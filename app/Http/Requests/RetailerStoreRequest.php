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
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id'           => ['nullable'],
            'dd_house_id'       => ['required'],
            'rso_id'            => ['required'],
            'supervisor_id'     => ['required'],
            'bts_id'            => ['nullable'],
            'route_id'          => ['required'],
            'code'              => ['required','unique:retailers,code'],
            'name'              => ['required'],
            'type'              => ['required'],
            'enabled'           => ['required'],
            'sim_seller'        => ['required'],
            'itop_number'       => ['required','unique:retailers,itop_number'],
            'service_point'     => ['required'],
            'owner_name'        => ['required'],
            'contact_no'        => ['required','unique:retailers,contact_no'],
            'own_shop'          => ['required'],
            'district'          => ['required'],
            'thana'             => ['required'],
            'address'           => ['required'],
            'blood_group'       => ['required'],
            'trade_license_no'  => ['nullable','unique:retailers,trade_license_no'],
            'others_operator'   => ['nullable'],
            'longitude'         => ['nullable'],
            'latitude'          => ['nullable'],
            'device_name'       => ['nullable'],
            'device_sn'         => ['nullable','unique:retailers,device_sn'],
            'scanner_sn'        => ['nullable','unique:retailers,scanner_sn'],
            'password'          => ['nullable'],
            'nid'               => ['required', new Nid,'unique:retailers,nid'],
            'nid_upload'        => ['nullable','image'],
        ];
    }
}
