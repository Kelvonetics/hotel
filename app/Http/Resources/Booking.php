<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Booking extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'room_id' => $this->room_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'cust_fullname' => $this->cust_fullname,
            'cust_email' => $this->cust_email,
            'total_night' => $this->total_night,
            'total_price' => $this->total_price,
            'user_id' => $this->user_id,
            'room' => $this->room,
            'user' => $this->user
        ];
    }
}
