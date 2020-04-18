<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function tourist() {
        return $this->belongsTo('App\Tourist');
    }

    public function service() {
        return $this->belongsTo('App\Service');
    }

    public function hotel() {
        return $this->belongsTo('App\Service');
    }
}
