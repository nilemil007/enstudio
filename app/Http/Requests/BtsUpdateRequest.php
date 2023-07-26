<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BtsUpdateRequest extends FormRequest
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
            'dd_house'              => ['required'],
            'site_id'               => ['required','starts_with:DHK_','unique:bts,site_id,'.request()->segment(2),'max:12',],
            'bts_code'              => ['required','starts_with:DHK','unique:bts,bts_code,'.request()->segment(2),'alpha_num','max:10',],
            'division'              => ['required','string','max:15',],
            'district'              => ['required','string','max:20'],
            'thana'                 => ['required','string','max:20'],
            'address'               => ['required','string'],
            'network_mode'          => ['required','string','max:10'],
            'latitude'              => ['required'],
            'longitude'             => ['required'],
            'two_g_on_air_date'     => ['required'],
            'three_g_on_air_date'   => ['nullable'],
            'four_g_on_air_date'    => ['nullable'],
            'urban_rural'           => ['required','string','max:20'],
        ];
    }
}
