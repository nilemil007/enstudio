<?php

namespace App\Http\Requests;

use App\Rules\Nid;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RsoStoreRequest extends FormRequest
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
            'rso_code'          => ['required','max:10','unique:rsos,rso_code'],
            'itop_number'       => ['required','numeric','digits: 11','unique:rsos,itop_number'],
            'pool_number'       => ['required','numeric','digits: 11','unique:rsos,pool_number'],
            'personal_number'   => ['required','numeric','digits: 11','unique:rsos,personal_number'],
            'rid'               => ['required','unique:rsos,rid'],
            'father_name'       => ['required','min: 3','max: 50','string'],
            'mother_name'       => ['required','min: 3','max: 50','string'],
            'division'          => ['required'],
            'district'          => ['required'],
            'thana'             => ['required'],
            'address'           => ['required','max: 200'],
            'blood_group'       => ['required'],
            'sr_no'             => ['required','max:8','unique:rsos,sr_no'],
            'account_number'    => ['required','unique:rsos,account_number'],
            'bank_name'         => ['required'],
            'brunch_name'       => ['required'],
            'routing_number'    => ['required','numeric'],
            'salary'            => ['required','numeric'],
            'education'         => ['required'],
            'marital_status'    => ['required'],
            'gender'            => ['required'],
            'dob'               => ['required','date'],
            'nid'               => ['required','numeric',new Nid,'unique:rsos,nid',],
            'document'          => ['nullable'],
            'residential_rso'   => ['required'],
            'joining_date'      => ['required','date'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return string[]
     */
     public function messages(): array
     {
         return [
             'user_id.required' => 'The user field is required.',
         ];
     }
}
