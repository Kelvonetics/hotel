<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Resources\Room as RoomResource;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->filled('all'))
        {
            $rooms = Room::orderBy('id', 'desc')->with(['room_type', 'hotel'])->get();
          return ['data'=>$rooms];         
        }
        else
        {
            $rooms = Room::orderBy('id', 'desc')->with(['room_type', 'hotel'])->paginate(5);
            return RoomResource::collection($rooms);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $room = $request->isMethod('put') ? Room::findOrFail($request->room_id) : new Room;

        // return $request->all();
        if($request->isMethod('put') == true)
        {
            $room->id = $request->room_id;
            $room->room_name = $request->room_name;
            $room->hotel_id = $request->hotel_id;
            $room->room_type_id = $request->room_type_id;
            // $room->room_image = $request->room_image;
        }
        else
        {
            //remove Extra Parts
            $room_image = $request->room_image;
            $exploded = explode(",",$room_image);

            //Extensions
            if(str_contains($exploded[0], 'png'))
            {
                $extension = 'png';
            }
            else if(str_contains($exploded[0], 'gif'))
            {
                $extension = 'gif';
            }
            else
            {
                $extension = 'jpg';
            }


            //Decoding
            $decoded = base64_decode($exploded[1]);
            $fileName = str_random() . "." .$extension;

            $fileName = str_random().'.'.$extension;
            $path = public_path().'/assets/images/uploads/'.$fileName;
            file_put_contents($path, $decoded);

            $room->id = $request->room_id;
            $room->room_name = $request->room_name;
            $room->hotel_id = $request->hotel_id;
            $room->room_type_id = $request->room_type_id;
            $room->room_image = $fileName;

        }
        

        

        if($room->save())
        {
            return new RoomResource($room);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $room = Room::findOrFail($id);
        return new RoomResource($room);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $room = Room::findOrFail($id);
        if($room->delete())
        {
            return new RoomResource($room);
        }
    }
}
