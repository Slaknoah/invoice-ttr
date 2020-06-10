<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'account_number',
        'sum',
        'commission'
    ];

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

    public function service() {
        return $this->belongsTo('App\Service');
    }

    public function hotel() {
        return $this->belongsTo('App\Service');
    }
}
