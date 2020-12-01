<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    //
    protected $fillable = ['room_name'];


    public function rooms()
    {
        return $this->hasMany('App\Room','room_type_id');
    }

    public function price_list()
    {
        return $this->hasOne('App\PriceList','room_type_id');
    }
}
