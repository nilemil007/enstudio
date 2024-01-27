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
            'dd_house_id'                   => ['required'],
            'user_id'                       => ['required','unique:rsos,user_id'],
            'supervisor_id'                 => ['required'],
            'rso_code'                      => ['required'],
            'routes'                        => ['required'],
            'itop_number'                   => ['required','numeric','digits: 11'],
            'pool_number'                   => ['required','numeric','digits: 11'],
            'sr_no'                         => ['required','max:8'],
            'residential_rso'               => ['required'],
            'date'                          => ['required','date'],
            'rid'                           => ['required','unique:rsos,rid'],
            'name'                          => ['required','min: 3','max: 50','string'],
            'father_name'                   => ['required','min: 3','max: 50','string'],
            'mother_name'                   => ['required','min: 3','max: 50','string'],
            'division'                      => ['required'],
            'district'                      => ['required'],
            'thana'                         => ['required'],
            'present_address'               => ['required','max: 200'],
            'permanent_address'             => ['required','max: 200'],
            'witness_name'                  => ['required','min: 3','max: 50','string'],
            'witness_number'                => ['required','numeric','digits: 11','unique:rsos,witness_number'],
            'salary'                        => ['required','numeric'],
            'employee_signature'            => ['required'],
            'personal_number'               => ['required','numeric','digits: 11','unique:rsos,personal_number'],
            'dob'                           => ['required','date'],
            'nid'                           => ['required','numeric',new Nid,'unique:rsos,nid',],
            'blood_group'                   => ['required'],
            'marital_status'                => ['required'],
            'nationality'                   => ['required'],
            'religion'                      => ['required'],
            'gender'                        => ['required'],
            'place_of_birth'                => ['required'],
            'rso_image'                     => ['required'],
            'education'                     => ['required'],
            'bank_name'                     => ['required'],
            'brunch_name'                   => ['required'],
            'routing_number'                => ['required','numeric'],
            'account_number'                => ['required','unique:rsos,account_number'],
            'nominee_name'                  => ['required','min: 3','max: 50','string'],
            'nominee_relation'              => ['required'],
            'nominee_contact_no'            => ['required','unique:rsos,nominee_contact_no'],
            'nominee_address'               => ['required','max: 200'],
            'rso_name_bangla'               => ['required'],
            'nominee_dob'                   => ['required','date'],
            'nominee_nid'                   => ['required','numeric',new Nid,'unique:rsos,nominee_nid',],
            'nominee_image'                 => ['required'],
            'nominee_signature'             => ['required'],
            'nominee_witness_name'          => ['required','min: 3','max: 50','string'],
            'nominee_witness_designation'   => ['required'],
            'nominee_witness_signature'     => ['required'],
            'joining_date'                  => ['required','date'],
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
