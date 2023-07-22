<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RouteStoreRequest extends FormRequest
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
            'dd_house_id' => ['required'],
            'code' => [
                'required',
                'unique:routes,code',
                'max:20',
            ],
            'name' => [
                'required',
                'string',
                'min:3',
                'max:30'
            ],
            'description' => [
                'required',
                'string',
                'min:3',
                'max:200',
            ],
            'weekdays' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'length' => ['nullable'],
        ];
    }
}
