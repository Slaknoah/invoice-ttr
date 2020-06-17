<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelStatus extends Model
{
    protected $guarded = [];

    public function hotelReservations() {
        return $this->hasMany('App\HotelReservation', 'status_id');
    }
}
