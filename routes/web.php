<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
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



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'HomeController@users')->name('users');



// Route::post('exams', 'ExamController@index');








Route::get('about', 'HomeController@about');











// Route to resolve Laravel to Vue Route
Route::get('/{vue_capture?}', function () 
{  
	// if(\Auth::guest()){
	// 	return redirect('login');
	// }
   return view('welcome');
})->where('vue_capture', '^(?!storage).*$'); 

