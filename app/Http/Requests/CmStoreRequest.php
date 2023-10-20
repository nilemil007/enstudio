<?php

namespace App\Http\Requests;

use App\Rules\Nid;
use Illuminate\Foundation\Http\FormRequest;

class CmStoreRequest extends FormRequest
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
            'dd_house_id'           => ['required'],
            'user_id'               => ['nullable'],
            'name'                  => ['required'],
            'designation'           => ['nullable'],
            'type'                  => ['nullable'],
            'pool_number'           => ['required','digits: 11','unique:cms,pool_number'],
            'personal_number'       => ['nullable','digits: 11','unique:cms,personal_number'],
            'nid_number'            => ['nullable',new Nid,'unique:cms,nid_number'],
            'father_name'           => ['nullable','min: 3','max: 50','string'],
            'mother_name'           => ['nullable','min: 3','max: 50','string'],
            'division'              => ['nullable','max: 50'],
            'district'              => ['nullable','max: 50'],
            'thana'                 => ['nullable','max: 50'],
            'address'               => ['nullable','max: 200'],
            'bank_account_name'     => ['nullable'],
            'bank_name'             => ['nullable'],
            'blood_group'           => ['nullable'],
            'salary'                => ['nullable','numeric'],
            'account_number'        => ['nullable','unique:cms,account_number'],
            'account_type'          => ['nullable'],
            'branch_name'           => ['nullable'],
            'education'             => ['nullable'],
            'gender'                => ['nullable'],
            'dob'                   => ['nullable','date'],
            'joining_date'          => ['nullable','date'],
            'status'                => ['nullable'],
            'remarks'               => ['nullable'],
            'documents'             => ['nullable','mimes:pdf'],
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
             'dd_house_id.required' => 'The :attribute is required.',
         ];
     }


    public function attributes(): array
    {
        return [
            'user_id'       => 'user',
            'dd_house_id'   => 'DD House',
        ];
    }
}
