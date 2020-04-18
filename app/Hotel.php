<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
	protected $casts = [
        'accommodations' => 'array'
    ];

    protected $fillable = [
    	'name',
    	'accommodations'
    ];

    public function invoices() {
        return $this->hasMany('App/Invoices');
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
