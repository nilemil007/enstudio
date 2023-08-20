<?php

namespace App\Http\Requests;

use App\Rules\Nid;
use Illuminate\Foundation\Http\FormRequest;

class RetailerUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
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
            'code'              => ['required','unique:retailers,code,'.request()->segment(2)],
            'name'              => ['required'],
            'type'              => ['required'],
            'enabled'           => ['required'],
            'sim_seller'        => ['required'],
            'itop_number'       => ['required','unique:retailers,itop_number,'.request()->segment(2)],
            'service_point'     => ['required'],
            'owner_name'        => ['required'],
            'contact_no'        => ['required','unique:retailers,contact_no,'.request()->segment(2)],
            'own_shop'          => ['required'],
            'district'          => ['required'],
            'thana'             => ['required'],
            'address'           => ['required'],
            'blood_group'       => ['required'],
            'trade_license_no'  => ['nullable','unique:retailers,trade_license_no,'.request()->segment(2)],
            'others_operator'   => ['nullable'],
            'longitude'         => ['nullable'],
            'latitude'          => ['nullable'],
            'device_name'       => ['nullable'],
            'device_sn'         => ['nullable','unique:retailers,device_sn,'.request()->segment(2)],
            'scanner_sn'        => ['nullable','unique:retailers,scanner_sn,'.request()->segment(2)],
            'password'          => ['nullable'],
            'nid'               => ['required', new Nid,'unique:retailers,nid,'.request()->segment(2)],
            'nid_upload'        => ['nullable','image'],
        ];
    }
}
