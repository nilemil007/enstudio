<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RouteUpdateRequest extends FormRequest
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
            'code' => [
                'required',
                'unique:routes,code,'.request()->segment(2),
                'max:20'
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
            'status' => ['nullable',],
        ];
    }
}
