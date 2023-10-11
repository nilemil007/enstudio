<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * @property mixed $image
 */
class UserUpdateRequest extends FormRequest
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
            'name'      => ['required', 'min:3', 'max:100',],
            'username'  => ['required', 'min:3', 'max:30', 'unique:users,username,'.request()->segment(2),],
            'phone'     => ['required', 'numeric', 'digits:11', 'starts_with:01', 'unique:users,phone,'.request()->segment(2),],
            'email'     => ['required', 'email', 'unique:users,email,'.request()->segment(2),],
            'role'      => ['required'],
            'password'  => ['nullable', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),],
            'image'     => ['sometimes', 'image', 'mimes:jpg,png,jpeg',],
            'status'    => ['nullable'],
        ];
    }
}
