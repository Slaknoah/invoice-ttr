<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany('App\Location', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Location', 'parent_id');
    }

    public function hotel() {
        return $this->hasMany('App\Hotel');
    }
}
