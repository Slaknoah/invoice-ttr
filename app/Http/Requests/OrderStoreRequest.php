<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'account_number'    => 'required|integer',
            'sum'               => 'required|numeric',
            'commission'        => 'nullable|numeric',
            'currency_id'       => 'required|integer',
            'client_id'         => 'required|integer',
            'manager_id'        => 'required|integer',
            'provider_id'       => 'required|integer',
            'bank_details_id'   => 'nullable|integer',
            'tourist_ids'       => 'nullable',
            'tourist_ids.*'     => 'nullable|integer'
        ];
    }
}
