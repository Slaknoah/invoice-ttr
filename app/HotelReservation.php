<?php

namespace App;

use App\Http\Requests\HotelReservationStoreRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class HotelReservation extends Model
{
    protected $guarded = [];

    public function hotel() {
        return $this->belongsTo('App\Hotel', 'hotel_id');
    }

    public function hotelStatus() {
        return $this->belongsTo('App\HotelStatus', 'hotel_status_id');
    }

    public function  order() {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }

    public function setDateStartAttribute($value) {
        if($value)
            $this->attributes['date_start'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
        else
            $this->attributes['date_start'] = null;
    }

    public function setDateEndAttribute($value) {
        if($value)
            $this->attributes['date_end'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
        else
            $this->attributes['date_end'] = null;
    }

    public static function storeData(HotelReservationStoreRequest $request) {
        $hotelReservation = new HotelReservation([
            'price'          => $request->price,
            'discount'       => $request->discount,
            'date_start'     => $request->date_start,
            'date_end'       => $request->date_end,
            'accommodation'  => $request->accommodation
        ]);

        $hotelReservation->hotel()->associate($request->get('hotel_id'));

        $hotelReservation->hotelStatus()->associate($request->get('hotel_status_id'));

        $hotelReservation->save();

        return $hotelReservation;
    }

//    public function getDateEndAttribute($value) {
//        return Carbon::parse($value)->format('d/m/Y');
//    }
}
