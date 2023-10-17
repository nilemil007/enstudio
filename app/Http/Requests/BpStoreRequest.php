<?php

namespace App\Http\Requests;

use App\Rules\Nid;
use Illuminate\Foundation\Http\FormRequest;

class BpStoreRequest extends FormRequest
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
            'supervisor_id'     => ['nullable'],
            'dd_house_id'       => ['required'],
            'response_id'       => ['nullable','unique:bps,response_id'],
            'type'              => ['required'],
            'pool_number'       => ['required','digits: 11','unique:bps,pool_number'],
            'personal_number'   => ['nullable','digits: 11','unique:bps,personal_number'],
            'father_name'       => ['nullable','min: 3','max: 50','string'],
            'mother_name'       => ['nullable','min: 3','max: 50','string'],
            'division'          => ['nullable'],
            'district'          => ['nullable'],
            'thana'             => ['nullable'],
            'address'           => ['nullable','max: 200'],
            'blood_group'       => ['nullable'],
            'account_number'    => ['nullable','unique:bps,account_number'],
            'bank_name'         => ['nullable'],
            'brunch_name'       => ['nullable'],
            'salary'            => ['nullable','numeric'],
            'education'         => ['nullable'],
            'gender'            => ['nullable'],
            'dob'               => ['nullable','date'],
            'nid'               => ['nullable',new Nid,'unique:bps,nid'],
            'documents'         => ['nullable','mimes:pdf'],
            'joining_date'      => ['nullable','date'],
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


    public function attributes(): array
    {
        return [
            'user_id'       => 'user',
            'supervisor_id' => 'supervisor',
            'dd_house_id'   => 'dd house',
            'response_id'   => 'response ID',
        ];
    }
}
