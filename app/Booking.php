<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = ['room_id', 'start_date', 'end_date','cust_fullname', 'cust_email','total_night', 'total_price','user_id'];


    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
