<?php

namespace App\Http\Controllers;

use App\RoomType;
use Illuminate\Http\Request;
use App\Http\Resources\RoomType as RoomTypeResource;

class RoomTypeController extends Controller
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
            $room_types = RoomType::orderBy('id', 'desc')->get();
          return ['data'=>$room_types];         
        }
        else
        {
            $room_types = RoomType::orderBy('id', 'desc')->paginate(5);
            return RoomTypeResource::collection($room_types);
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
        $room_type = $request->isMethod('put') ? RoomType::findOrFail($request->room_type_id) : new RoomType;

        // return $request->all();
        if($request->isMethod('put') == true)
        {
            $room_type->id = $request->room_type_id;
            $room_type->room_name = $request->room_name;
        }
        else
        {
            $room_type->room_name = $request->room_name;

        }

        if($room_type->save())
        {
            return new RoomTypeResource($room_type);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $room_type = RoomType::findOrFail($id);
        return new RoomTypeResource($room_type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomType $roomType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $room_type = RoomType::findOrFail($id);
        if($room_type->delete())
        {
            return new RoomTypeResource($room_type);
        }
    }
}
