<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelStatus extends Model
{
    protected $fillable = ['name', 'email_text', 'whatsapp_text'];
}
