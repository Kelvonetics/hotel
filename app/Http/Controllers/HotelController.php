<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Hotel as HotelResource;

class HotelController extends Controller
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
            $hotels = \App\Hotel::orderBy('id', 'desc')->get();
          return ['data'=>$hotels];         
        }
        else
        {
            $hotels = \App\Hotel::orderBy('id', 'desc')->paginate(5);
            return HotelResource::collection($hotels);
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
        $hotel = $request->isMethod('put') ? \App\Hotel::findOrFail($request->hotel_id) : new \App\Hotel;

        // return $request->all();
        if($request->isMethod('put') == true)
        {
            $hotel->id = $request->hotel_id;
            $hotel->name = $request->name;
            $hotel->address = $request->address;
            $hotel->city = $request->city;
            $hotel->state = $request->state;
            $hotel->country = $request->country;
            $hotel->zip_code = $request->zip_code;
            $hotel->phone_number = $request->phone_number;
            $hotel->email = $request->email;
            // $hotel->image = $fileName;
        }
        else
        {
            //remove Extra Parts
            $image = $request->image;
            $exploded = explode(",",$image);

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

            $hotel->id = $request->hotel_id;
            $hotel->name = $request->name;
            $hotel->address = $request->address;
            $hotel->city = $request->city;
            $hotel->state = $request->state;
            $hotel->country = $request->country;
            $hotel->zip_code = $request->zip_code;
            $hotel->phone_number = $request->phone_number;
            $hotel->email = $request->email;
            $hotel->image = $fileName;

        }
        

        

        if($hotel->save())
        {
            return new HotelResource($hotel);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $hotel = \App\Hotel::findOrFail($id);
        return new HotelResource($hotel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $hotel = \App\Hotel::findOrFail($id);
        if($hotel->delete())
        {
            return new HotelResource($hotel);
        }
    }
}
