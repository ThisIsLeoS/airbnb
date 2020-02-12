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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get("/" , "HomePageController@index")-> name("home.page");

//Apartment route
Route::get("/apartment/{id}/show" , "ApartmentController@show") -> name("apartment.show");
Route::get('/apartament/message/user/{id}/show', 'ApartmentController@apartmentUserMessageShow') -> name('apartmentUserMessage.show');



//User route
Route::get('/user/{id}/show', 'UserController@show') -> name('user.show');
Route::get('/user/{id}/show/apartment' , 'UserController@userApartmentShow') -> name('userApartment.show');
Route::get('/user/delete/apartment/{id}', 'ApartmentController@userApartmentDelete') -> name('user.delete.apartment');


//Message route
Route::post("/apartment/{id}/show" , "MessageController@createMessageForApt") -> name("message.apartment.create");
