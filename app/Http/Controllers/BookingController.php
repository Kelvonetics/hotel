<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Booking as BookingResource;

class BookingController extends Controller
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
            $bookings = Booking::orderBy('id', 'desc')->with(['room', 'user'])->get();
          return ['data'=>$bookings];         
        }
        else
        {
            $bookings = Booking::orderBy('id', 'desc')->with(['room', 'user'])->paginate(5);
            return BookingResource::collection($bookings);
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
        $booking = $request->isMethod('put') ? Booking::findOrFail($request->booking_id) : new Booking;
        //Calculating total number of night 
        $total_night = Carbon::parse(request('start_date'))->diffInDays(Carbon::parse(request('end_date')));

        //Calculating Total Price Based On Room Type Selected
        $price = $booking->room->room_type->price_list->price;

        // return $request->all();
        if($request->isMethod('put') == true)
        {
            $booking->id = $request->booking_id;
            $booking->room_id = $request->room_id;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;
            $booking->cust_fullname = $request->cust_fullname;
            $booking->cust_email = $request->cust_email;
            $booking->total_night = $total_night;
            $booking->total_price = round(($total_night * $price), 2);
            $booking->user_id = $request->user_id;
        }
        else
        {
            // $booking->id = $request->booking_id;
            $booking->room_id = $request->room_id;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;
            $booking->cust_fullname = $request->cust_fullname;
            $booking->cust_email = $request->cust_email;
            $booking->total_night = $total_night;
            $booking->total_price = round(($total_night * $price), 2);
            $booking->user_id = $request->user_id;

        }
        
        if($booking->save())
        {
            return new BookingResource($booking);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $booking = Booking::findOrFail($id);
        return new BookingResource($booking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $booking = Booking::findOrFail($id);
        if($booking->delete())
        {
            return new BookingResource($booking);
        }
    }




    public function BookingCalendar(Request $request)
    {   
        // $startdate=$request->start;        $enddate=$request->end;
        $s_date = Booking::orderBy('start_date', 'asc')->first();        $startdate = $s_date->start_date;
        $e_date = Booking::orderBy('end_date', 'desc')->first();         $enddate = $e_date->end_date;

        // return $startdate->start_date .' : '.$enddate->end_date;

        $bookings = Booking::whereBetween('start_date', [$startdate, $enddate])->orWhereBetween('end_date', [$startdate, $enddate])->get();
        // return $bookings;
        
        $colours=[ '#67a8e4', '#f32f53', '#77c949', '#FFC1CC', '#ffbb44', '#f32f53', '#67a8e4'];
        $cal=[];

        foreach($bookings as $booking)
        {
            $begin = new \DateTime($booking->start_date);
            $end = new \DateTime($booking->end_date. '+1 days');
           
            $interval = \DateInterval::createFromDateString('1 day');
            $period = new \DatePeriod($begin, $interval, $end);

            foreach ($period as $dt) 
            {               
                $cal[] = ['title'=>'Reserved', 'start'=>$dt->format(" Y-m-d"), 'end'=>$dt->format(" Y-m-d"), 'color' =>'#202020', 'id'=>$booking->id];
            }          
        }


        

 

            if(isset($cal)):
                // return response()->json($cal);
                return ['data'=>$cal];
            else:
            $cal=['title'=>'Nil','start'=>'2016-09-09'];
                return ['data'=>$cal];
            endif;

 


    }
}
