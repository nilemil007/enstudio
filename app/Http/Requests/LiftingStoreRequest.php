<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiftingStoreRequest extends FormRequest
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
            'dd_house_id'                   => ['required'],
            'mmst'                          => ['nullable'],
            'mmst_lifting_price'            => ['nullable'],
            'mmst_amount'                   => ['nullable'],
            'mmst_remarks'                  => ['nullable'],
            'mmsts'                         => ['nullable'],
            'mmsts_lifting_price'           => ['nullable'],
            'mmsts_amount'                  => ['nullable'],
            'mmsts_remarks'                 => ['nullable'],
            'sim_swap'                      => ['nullable'],
            'sim_swap_lifting_price'        => ['nullable'],
            'sim_swap_amount'               => ['nullable'],
            'sim_swap_remarks'              => ['nullable'],
            'sim_swap_ev'                   => ['nullable'],
            'sim_swap_ev_lifting_price'     => ['nullable'],
            'sim_swap_ev_amount'            => ['nullable'],
            'sim_swap_ev_remarks'           => ['nullable'],
            'total_sim_amount'              => ['nullable'],
            'sc_10'                         => ['nullable'],
            'sc_10_lifting_price'           => ['nullable'],
            'sc_10_amount'                  => ['nullable'],
            'sc_10_lifting_amount'          => ['nullable'],
            'sc_10_remarks'                 => ['nullable'],
            'sc_14'                         => ['nullable'],
            'sc_14_lifting_price'           => ['nullable'],
            'sc_14_amount'                  => ['nullable'],
            'sc_14_lifting_amount'          => ['nullable'],
            'sc_14_remarks'                 => ['nullable'],
            'scd_14'                        => ['nullable'],
            'scd_14_lifting_price'          => ['nullable'],
            'scd_14_amount'                 => ['nullable'],
            'scd_14_lifting_amount'         => ['nullable'],
            'scd_14_remarks'                => ['nullable'],
            'sc_19'                         => ['nullable'],
            'sc_19_lifting_price'           => ['nullable'],
            'sc_19_amount'                  => ['nullable'],
            'sc_19_lifting_amount'          => ['nullable'],
            'sc_19_remarks'                 => ['nullable'],
            'scd_19'                        => ['nullable'],
            'scd_19_lifting_price'          => ['nullable'],
            'scd_19_amount'                 => ['nullable'],
            'scd_19_lifting_amount'         => ['nullable'],
            'scd_19_remarks'                => ['nullable'],
            'sc_20'                         => ['nullable'],
            'sc_20_lifting_price'           => ['nullable'],
            'sc_20_amount'                  => ['nullable'],
            'sc_20_lifting_amount'          => ['nullable'],
            'sc_20_remarks'                 => ['nullable'],
            'scd_29'                        => ['nullable'],
            'scd_29_lifting_price'          => ['nullable'],
            'scd_29_amount'                 => ['nullable'],
            'scd_29_lifting_amount'         => ['nullable'],
            'scd_29_remarks'                => ['nullable'],
            'total_sc_amount'               => ['nullable'],
            'total_sc_lifting_amount'       => ['nullable'],
            'router'                        => ['nullable'],
            'router_price'                  => ['nullable'],
            'router_lifting_price'          => ['nullable'],
            'router_amount'                 => ['nullable'],
            'router_lifting_amount'         => ['nullable'],
            'router_remarks'                => ['nullable'],
            'total_device_amount'           => ['nullable'],
            'total_device_lifting_amount'   => ['nullable'],
            'itopup'                        => ['nullable'],
            'itopup_remarks'                => ['nullable'],
            'bank_deposit'                  => ['required'],
        ];
    }
}
