<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'description'];

    public function orders() {
        return $this->hasMany('App/Invoices');
    }
}
