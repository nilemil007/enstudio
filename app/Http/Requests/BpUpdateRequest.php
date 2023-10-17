<?php

namespace App\Http\Requests;

use App\Rules\Nid;
use Illuminate\Foundation\Http\FormRequest;

class BpUpdateRequest extends FormRequest
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
            'response_id'       => ['required','unique:bps,response_id,'.request()->segment(2)],
            'type'              => ['required'],
            'pool_number'       => ['required','numeric','digits: 11','unique:bps,pool_number,'.request()->segment(2)],
            'personal_number'   => ['nullable','numeric','digits: 11','unique:bps,personal_number,'.request()->segment(2)],
            'father_name'       => ['nullable','min: 3','max: 50','string'],
            'mother_name'       => ['nullable','min: 3','max: 50','string'],
            'division'          => ['nullable'],
            'district'          => ['nullable'],
            'thana'             => ['nullable'],
            'address'           => ['nullable','max: 200'],
            'blood_group'       => ['nullable'],
            'account_number'    => ['nullable','unique:bps,account_number,'.request()->segment(2)],
            'bank_name'         => ['nullable'],
            'brunch_name'       => ['nullable'],
            'salary'            => ['nullable','numeric'],
            'education'         => ['nullable'],
            'gender'            => ['nullable'],
            'dob'               => ['nullable','date'],
            'nid'               => ['nullable','numeric',new Nid,'unique:bps,nid,'.request()->segment(2)],
            'documents'         => ['sometimes','mimes:pdf'],
            'joining_date'      => ['nullable','date'],
            'resigning_date'    => ['nullable','date'],
        ];
    }
}
