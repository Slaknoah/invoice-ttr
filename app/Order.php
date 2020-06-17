<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function client() {
        return $this->belongsTo('App\User', 'client_id', 'id');
    }

    public function manager() {
        return $this->belongsTo('App\User', 'manager_id', 'id');
    }

    public function  provider() {
        return $this->belongsTo('App\Provider', 'provider_id', 'id');
    }

    public function tourists() {
        return $this->belongsToMany('App\Tourist');
    }

    public function payments() {
        return $this->hasMany('App\Payment', 'order_id', 'id');
    }

    public function service() {
        return $this->belongsTo('App\Service');
    }

    public function hotelReservations() {
        return $this->hasMany('App\HotelReservation', 'order_id', 'id');
    }
}
