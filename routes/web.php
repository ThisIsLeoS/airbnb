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
Route::get("/apartment/create", "ApartmentController@create")->name("apartment.create");
Route::post("/apartment/{id}/store", "ApartmentController@store")->name("apartment.store");
Route::get('/apartament/message/user/{id}/show', 'ApartmentController@apartmentUserMessageShow') -> name('apartmentUserMessage.show');
Route::get('/apartament/{id}/edit', 'ApartmentController@edit') -> name('apartment.edit');
Route::post('/apartament/{id}/update', 'ApartmentController@update') -> name('apartment.update');
Route::get('/apartment/search', "ApartmentController@apartmentSearch") ->name('apartment.search');
Route::post('/apartament/search', 'ApartmentController@apartmentAdvSearch') -> name('apartment.adv.search');
Route::get('/apartament/{id}/statistics', 'ApartmentController@apartmentStatistics') -> name('apartment.stats');
Route::post('/apartment/handle-views', 'ApartmentController@handleAptViews')->name('apartment.handleViews');

// Sponsorship routes
Route::get("/apartment/{id}/sponsorship", "ApartmentController@sendTokenToClient")-> name("apartment.sponsorship");
Route::post("/apartment/sponsorship", "ApartmentController@sendNonceToServer")-> name("apartment.sendNonce");


//User route
Route::get('/user/{id}/show', 'UserController@show') -> name('user.show');
Route::get('/user/{id}/show/apartment' , 'UserController@userApartmentShow') -> name('userApartment.show');
Route::get('/user/delete/apartment/{id}', 'ApartmentController@userApartmentDelete') -> name('user.delete.apartment');
Route::post('user/image/set' , "UserController@setUserImage") -> name("user.set.image");

//Message route
Route::post("/apartment/{id}/show" , "MessageController@createMessageForApt") -> name("message.apartment.create");


