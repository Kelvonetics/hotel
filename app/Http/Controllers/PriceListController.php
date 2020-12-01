<?php

namespace App\Http\Controllers;

use App\PriceList;
use Illuminate\Http\Request;
use App\Http\Resources\PriceList as PriceListResource;

class PriceListController extends Controller
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
            $price_lists = PriceList::orderBy('id', 'desc')->get();
          return ['data'=>$price_lists];         
        }
        else
        {
            $price_lists = PriceList::orderBy('id', 'desc')->paginate(5);
            return PriceListResource::collection($price_lists);
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
        $price_list = $request->isMethod('put') ? PriceList::findOrFail($request->price_list_id) : new PriceList;

        // return $request->all();
        if($request->isMethod('put') == true)
        {
            $price_list->id = $request->price_list_id;
            $price_list->price = $request->price;
            $price_list->room_type_id = $request->room_type_id;
        }
        else
        {

            // $price_list->id = $request->price_list_id;
            $price_list->price = $request->price;
            $price_list->room_type_id = $request->room_type_id;

        }
        
        if($price_list->save())
        {
            return new PriceListResource($price_list);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $price_list = PriceList::findOrFail($id);
        return new PriceListResource($price_list);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceList $priceList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceList $priceList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $price_list = PriceList::findOrFail($id);
        if($price_list->delete())
        {
            return new PriceListResource($price_list);
        }
    }
}
