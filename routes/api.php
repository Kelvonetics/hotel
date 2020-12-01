<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Route::get('/', function () 
// {
//     return view('auth.login');
// });



Route::post('/authenticate','Auth\Login@authenticate')->name('authenticate');

// Auth::routes();

Route::get('/', function () 
{
    return view('welcome');
});

Route::middleware('auth:api')->get('/user', function (Request $request) 
{
    return $request->user();
});








//dashboard
Route::get('get_exams', 'HomeController@getExams');
Route::get('completed_exams', 'HomeController@completedExams');
Route::get('total_live_exams', 'HomeController@totalLiveExams');
Route::get('total_exam_users', 'HomeController@totalExamUsers');
Route::get('users_finished', 'HomeController@finishedUsers');
Route::get('total_live_users', 'HomeController@totalLiveUsers');







//Hotels
Route::get('hotels', 'HotelController@index');
Route::get('hotel/{id}', 'HotelController@show');
Route::post('hotel', 'HotelController@store');
Route::put('hotel', 'HotelController@store');
Route::delete('hotel/{id}', 'HotelController@destroy');

//ROOMS
Route::get('rooms', 'RoomController@index', function() { return Room::with(['hotel', 'room_type'])->get(); });
Route::get('room/{id}', 'RoomController@show');
Route::post('room', 'RoomController@store');
Route::put('room', 'RoomController@store');
Route::delete('room/{id}', 'RoomController@destroy');

//ROOMS
Route::get('room_types', 'RoomTypeController@index');
Route::get('room_type/{id}', 'RoomTypeController@show');
Route::post('room_type', 'RoomTypeController@store');
Route::put('room_type', 'RoomTypeController@store');
Route::delete('room_type/{id}', 'RoomTypeController@destroy');

//PRICELIST
Route::get('price_lists', 'PriceListController@index', function() { return PriceList::with(['room_type'])->get(); });
Route::get('price_list/{id}', 'PriceListController@show');
Route::post('price_list', 'PriceListController@store');
Route::put('price_list', 'PriceListController@store');
Route::delete('price_list/{id}', 'PriceListController@destroy');

//Booking
Route::get('bookings', 'BookingController@index', function() { return Booking::with(['room', 'user'])->get(); });
Route::get('booking/{id}', 'BookingController@show');
Route::post('booking', 'BookingController@store');
Route::put('booking', 'BookingController@store');
Route::delete('booking/{id}', 'BookingController@destroy');

Route::get('bookings/calendar', 'BookingController@BookingCalendar');


//List Users
Route::get('users', 'UserController@index', function() { return User::with('state')->get(); });
Route::get('user/{id}', 'UserController@show');
Route::post('user', 'UserController@store');
Route::put('user', 'UserController@store');
Route::delete('user/{id}', 'UserController@destroy');

