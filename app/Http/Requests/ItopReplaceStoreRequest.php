<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ItopReplaceStoreRequest extends FormRequest
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
            'user_id'       => ['required'],
            'itop_number'   => ['required','starts_with:019,014','digits:11'],
            'serial_number' => ['digits:18','unique:itop_replaces,serial_number'],
            'description'   => ['max:100'],
            'balance'       => ['nullable'],
            'reason'        => ['nullable'],
        ];
    }
}
