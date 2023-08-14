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
            'user_id'           => ['required'],
            'supervisor'        => ['required'],
            'dd_house_id'       => ['required'],
            'response_id'       => ['required'],
            'type'              => ['required'],
            'pool_number'       => ['required','numeric','digits: 11','unique:bps'],
            'personal_number'   => ['required','numeric','digits: 11','unique:bps'],
            'father_name'       => ['required','min: 3','max: 50','string'],
            'mother_name'       => ['required','min: 3','max: 50','string'],
            'division'          => ['required'],
            'district'          => ['required'],
            'thana'             => ['required'],
            'address'           => ['required','max: 200'],
            'blood_group'       => ['required'],
            'account_number'    => ['required','unique:bps'],
            'bank_name'         => ['required'],
            'brunch_name'       => ['required'],
            'salary'            => ['required','numeric'],
            'education'         => ['required'],
            'gender'            => ['required'],
            'dob'               => ['required','date'],
            'nid'               => ['required','numeric',new Nid,'unique:bps,nid'],
            'documents'         => ['nullable'],
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
             'user_id.required' => 'The rso field is required.',
         ];
     }
}
