<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    protected $fillable = ['name', 'address', 'city','state', 'country','zip_code', 'phone_number','email', 'images'];


    public function hotel_manager()
    {
        return $this->hasMany('App\HotelManager');
    }
}
