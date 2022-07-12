<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('guest.home');
// });

// Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// Back-end route
Route::middleware('auth')
->prefix('admin')
->name('admin.')
->namespace('Admin')
->group( function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('habitations', 'HabitationController');

    Route::get('sponsorship/{habitation}', 'SponsorController@index')->name('sponsor');

    Route::get('payments/{habitation}/{sponsorship}', 'PaymentsController@generate')->name('pay');
    Route::post('payments/checkout/{habitation}/{sponsorship}', 'PaymentsController@makePayment')->name('pay.checkout');
});

// Front-end route
Route::get('{any?}',function(){
    return view('guest.home');
} )->where('any', ".*");


