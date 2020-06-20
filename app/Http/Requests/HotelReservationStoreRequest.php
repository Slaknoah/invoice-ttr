<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelReservationStoreRequest extends FormRequest
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
            'hotel_id'          => 'required|integer',
            'date_start'        => 'nullable|date_format:' . config('app.date_format'),
            'date_end'          => 'nullable|date_format:' . config('app.date_format'),
            'price'             => 'required|numeric',
            'discount'          => 'nullable|numeric',
            'hotel_status_id'   => 'required|integer',
            'accommodation'     => 'required|string'
        ];
    }
}
