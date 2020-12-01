<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    //
    // protected $table = 'price_lists';
    protected $fillable = ['price', 'room_type_id'];


    public function room_type()
    {
        return $this->belongsTo('App\RoomType');
    }

}
