<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelReservation extends Model
{
    protected $guarded = [];

    public function hotel() {
        return $this->belongsTo('App\Hotel', 'hotel_id');
    }

    public function hotelStatus() {
        return $this->belongsTo('App\HotelStatus', 'status_id');
    }

    public function  order() {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }
}
