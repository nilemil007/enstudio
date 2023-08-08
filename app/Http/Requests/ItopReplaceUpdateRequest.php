<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ItopReplaceUpdateRequest extends FormRequest
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
            'itop_number'   => ['required','starts_with:019,014','digits:11'],
            'serial_number' => ['digits:18','unique:itop_replaces,serial_number,'.request()->segment(2)],
            'description'   => ['max:100'],
            'reason'        => ['required'],
            'balance'       => ['required'],
            'pay_amount'    => ['nullable'],
            'status'        => ['nullable'],
        ];
    }
}
