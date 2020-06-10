<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable= ['name', 'from_email', 'to_email', 'to_phone', 'send_to_email', 'send_to_phone'];

    public function orders() {
        return $this->hasMany('App\Order', 'provider_id', 'id');
    }
}
