<?php

namespace App\Http\Requests;

use App\Rules\Nid;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RsoUpdateRequest extends FormRequest
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
            'user_id'           => ['required'],
            'supervisor_id'     => ['required'],
            'dd_house_id'       => ['required'],
            'routes'            => ['sometimes'],
            'rso_code'          => ['required', 'max:10', 'unique:rsos,rso_code,'.request()->segment(2)],
            'itop_number'       => ['required', 'numeric', 'digits: 11', 'unique:rsos,itop_number,'.request()->segment(2)],
            'pool_number'       => ['required', 'numeric', 'digits: 11', 'unique:rsos,pool_number,'.request()->segment(2)],
            'personal_number'   => ['required', 'numeric', 'digits: 11', 'unique:rsos,personal_number,'.request()->segment(2)],
            'rid'               => ['required', 'unique:rsos,rid,'.request()->segment(2)],
            'father_name'       => ['required', 'min: 3', 'max: 50', 'string'],
            'mother_name'       => ['required', 'min: 3', 'max: 50', 'string'],
            'division'          => ['required'],
            'district'          => ['required'],
            'thana'             => ['required'],
            'address'           => ['required', 'max: 200'],
            'blood_group'       => ['required'],
            'sr_no'             => ['required', 'max:8', 'unique:rsos,sr_no,'.request()->segment(2)],
            'account_number'    => ['required', 'unique:rsos,account_number,'.request()->segment(2)],
            'bank_name'         => ['required'],
            'brunch_name'       => ['required'],
            'routing_number'    => ['required', 'numeric'],
            'salary'            => ['required', 'numeric'],
            'education'         => ['required'],
            'marital_status'    => ['required'],
            'gender'            => ['required'],
            'dob'               => ['required', 'date'],
            'nid'               => ['required', 'numeric', new Nid, 'unique:rsos,nid,'.request()->segment(2),],
            'document'          => ['nullable'],
            'residential_rso'   => ['required'],
            'joining_date'      => ['required', 'date'],
            'resigning_date'    => ['nullable', 'date'],
            'status'            => ['nullable'],
        ];
    }
}
