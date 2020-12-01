<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
   
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = \App\User::orderBy('id', 'desc')->paginate(15);
        return UserResource::collection($users);
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
        $user = $request->isMethod('put') ? \App\User::findOrFail($request->user_id) : new \App\User;

        //\log::info($request->all());
        //remove Extra Parts
        $photo = $request->photo;
        $exploded = explode(",",$photo);

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
        $path = public_path().'/assets/dist/img/uploads/'.$fileName;
        file_put_contents($path, $decoded);

        $user->id = $request->user_id;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->state_id = $request->state_id;
        $user->nationality = $request->nationality;
        $user->photo = $fileName;
        $user->created_by = 1;

        if($user->save())
        {
            return new UserResource($user);
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
        $user = \App\User::findOrFail($id);
        return new UserResource($user);
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
        $user = \App\User::findOrFail($id);
        if($user->delete())
        {
            return new UserResource($user);
        }
    }
}
