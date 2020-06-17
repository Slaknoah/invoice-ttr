<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'price'         => $this->price,
            'discount'      => $this->discount,
            'date_start'    => $this->date_start,
            'date_end'      => $this->date_end,
            'accommodation' => $this->accommodation,
            'hotel'         => $this->hotel,
            'order_id'      => $this->order_id,
            'status'        => $this->hotelStatus
        ];
    }
}
