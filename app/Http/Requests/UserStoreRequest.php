<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * @property mixed $image
 */
class UserStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'min:3',
                'max:100',
            ],
            'username' => [
                'required',
                'min:3',
                'max:30',
                'unique:users,username',
            ],
            'phone' => [
                'required',
                'numeric',
                'digits:11',
                'starts_with:01',
                'unique:users,phone',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'role' => ['required'],
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'image' => [
                'sometimes',
                'mimes:jpg,png,jpeg',
            ],
            'status' => ['nullable'],
        ];
    }
}
