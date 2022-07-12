<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api', function (){
    Route::get('/user', 'UserController@index');
});


Route::namespace('Api')->group(function(){

    // Dashboard 
    Route::get('/habitations', 'HabitationApi@index');

    // Habitations Sponsored
    Route::get('/habitations/sponsor', 'HabitationApi@getSponsored');
    
    // Advanced Search
    Route::get('/search', 'HabitationApi@getParams');
    Route::get('/services', 'HabitationApi@getServices');

    // Habitation Details
    Route::get('/habitations/{slug}', 'HabitationApi@show');


    // Contact Form
    Route::post('/messages', 'ContactMessageController@send');

});


