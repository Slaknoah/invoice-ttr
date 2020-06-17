<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id'                => (string) $this->id,
            'account_number'    => $this->account_number,
            'sum'               => $this->sum,
            'commission'        => $this->commission,
            'client'            => $this->client,
            'manager'           => $this->manager,
            'provider'          => $this->provider,
            'tourists'          => $this->tourists,
            'hotel_reservations'=> $this->hotelReservations,
            'payments'          => $this->payments,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
