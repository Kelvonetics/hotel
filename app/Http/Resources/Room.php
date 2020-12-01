<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Room extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return
        [
            'id' => $this->id,
            'room_name' => $this->room_name,
            'hotel_id' => $this->hotel_id,
            'room_type_id' => $this->room_type_id,
            'room_image' => $this->room_image,
            'hotel' => $this->hotel,
            'room_type' => $this->room_type,
            'bookings' => $this->bookings
        ];
    }
}
