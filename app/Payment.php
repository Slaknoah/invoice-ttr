<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['sum', 'order_id', 'payment_type', 'comment'];

    public function order() {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }
}
