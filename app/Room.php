<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $fillable = ['room_name', 'hotel_id', 'room_type_id','room_image'];


    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }

    public function room_type()
    {
        return $this->belongsTo('App\RoomType');
    }


    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
