<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
	protected $casts = [
        'accommodations' => 'array'
    ];

    protected $guarded = [];

    public function hotelReservations() {
        return $this->hasMany('App/HotelReservation', 'hotel_id');
    }

    public function setAccommodationsAttribute($value)
	{
	    $accommodations = [];

	    foreach ($value as $array_item) {
	        if (!is_null($array_item)) {
	            $accommodations[] = $array_item;
	        }
	    }

	    $this->attributes['accommodations'] = json_encode($accommodations);
	}
}
