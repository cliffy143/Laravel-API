<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiContactController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/contacts', 'App\Http\Controllers\ApiContactController@store');
//Route::get('/contacts', 'App\Http\Controllers\ApiContactController@index');
//Route::get('/contacts/{id}', 'App\Http\Controllers\ApiContactController@show');
//Route::patch('/contacts/{id}', 'App\Http\Controllers\ApiContactController@update');

Route::resource('contacts', 'App\Http\Controllers\ApiContactController');
//the resource method does all the methods in one

//if you get a target error its becuase you must reference it like this
//show method is used to pull only 1 data from the database
//put and patch method basically do the same thing