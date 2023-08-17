<?php

namespace App\Http\Requests;

use App\Rules\Nid;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SupervisorStoreRequest extends FormRequest
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
            'dd_house_id' => ['required'],
            'user_id' => ['required'],
            'pool_number' => [
                'required',
                'digits:11',
                'unique:supervisors,pool_number',
            ],
            'father_name' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'mother_name' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'division' => [
                'required',
                'string',
                'min:3',
                'max:20',
            ],
            'district' => [
                'required',
                'string',
                'min:3',
                'max:20',
            ],
            'thana' => [
                'required',
                'string',
                'min:3',
                'max:20',
            ],
            'address' => [
                'required',
                'string',
                'min:3',
                'max:150',
            ],
            'nid' => [
                'required',
                'numeric',
                new Nid,
                'unique:supervisors,nid',
            ],
            'dob' => [
                'required',
                'date',
            ],
            'joining_date' => [
                'required',
                'date',
            ],
        ];
    }
}
