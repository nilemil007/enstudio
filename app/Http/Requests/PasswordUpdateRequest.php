<?php

namespace App\Http\Requests;

use App\Rules\CheckExistingPassword;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordUpdateRequest extends FormRequest
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
            'current_password' => ['required', new CheckExistingPassword($this->user())],
            'password' => ['required','confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ];
    }
}
