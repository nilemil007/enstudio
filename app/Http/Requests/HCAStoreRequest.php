<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $retailer_code
 */
class HCAStoreRequest extends FormRequest
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
            'user_id'           => ['required'],
            'retailer_code'     => ['required'],
            'activation'        => ['required'],
            'price'             => ['required'],
            'activation_date'   => ['required'],
            'flag'              => ['nullable'],
            'remarks'           => ['nullable'],
        ];
    }
}
