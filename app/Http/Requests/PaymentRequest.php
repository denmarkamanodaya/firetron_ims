<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'            => 'required',
            'middle_name'           => 'required',
            'last_name'             => 'required',
            'address_1'             => 'required',
            'address_2'             => 'required',
            'city'                  => 'required',
            'state'                 => 'required',
            'country'               => 'required',
            'zip_code'              => 'required|numeric',
            'email_address'         => 'required|email',
            'mobile_number'         => 'required|numeric',
            // 'phone_number'          => 'required|numeric',
            'sbc_account_number'    => 'required|numeric',
            'deposit_amount'        => 'required|between:0,99.99',
            'fees'                  => 'required|between:0,99.99',
            'promo_code'            => 'required_with:deposit_amount,fees|alpha_num',
            'currency'              => 'required'
            // 'discount' => 'required|between:0,99.99',
            // 'net_payment' => 'required|between:0,99.99'
        ];
    }
}
