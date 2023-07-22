<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DdHouseStoreRequest extends FormRequest
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
            'cluster_name'      => ['required','max:30'],
            'region'            => ['required','max:20'],
            'code'              => ['required','max:10', 'unique:dd_houses,code'],
            'name'              => ['required','min:3','max:100'],
            'email'             => ['required','email','unique:dd_houses,email'],
            'district'          => ['required','max:20'],
            'address'           => ['required','max:150'],
            'proprietor_name'   => ['required','min:3','max:100'],
            'proprietor_number' => ['required','numeric','digits:11','starts_with:01',],
            'poc_name'          => ['required','min:3','max:100'],
            'poc_number'        => ['required','numeric','digits:11','starts_with:01',],
            'tin_number'        => ['required','unique:dd_houses,tin_number'],
            'bin_number'        => ['required','unique:dd_houses,bin_number'],
            'latitude'          => ['nullable','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude'         => ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'bts_code'          => ['required','starts_with:DHK','min:7','max:9'],
            'lifting_date'      => ['required','date'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'latitude.regex'        => 'Invalid latitude value',
            'longitude.regex'       => 'Invalid longitude value',
            'bts_code.starts_with'  => 'BTS code must starts with: DHK',
        ];
    }
}
