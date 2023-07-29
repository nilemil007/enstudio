<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $retailer_code
 */
class HCAUpdateRequest extends FormRequest
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
            'user_id'           => ['required'],
            'dd_house'          => ['nullable'],
            'retailer_code'     => ['required'],
            'activation'        => ['required'],
            'price'             => ['required'],
            'activation_date'   => ['required'],
        ];
    }
}
