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

use Illuminate\Support\Facades\Auth;
//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/available','Frontend\SearchController@search')->name('available.rooms');
Route::post('/available','Frontend\SearchController@search')->name('rooms.available');
Route::get('/rooms','Frontend\SiteController@rooms')->name('rooms');
Route::get('/services','Frontend\SiteController@services')->name('services');
Route::get('/places','Frontend\SiteController@places')->name('places');
Route::get('/rooms/{room_no}','Frontend\SiteController@singleRoom')->name('single.room');
Route::get('/places/{name}','Frontend\SiteController@visitPlace')->name('single.place');
Route::get('/service/{name}','Frontend\SiteController@servicePage')->name('single.service');

//Route::get('create','Frontend\BookingController@create')->name('book.room');
//Route::post('update/{id}','BookingController@update')->name('room.create');

Route::resource('bookingroom','Frontend\BookingController');

Route::group(['prefix'=>'admin/'],function (){
    Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard','Admin\DashboardController@index')->name('dashboard');

    Route::resource('users', 'Admin\UserController');
    Route::get('getUsers', 'Admin\UserController@getUsers');

    Route::resource('roles', 'Admin\RolesController');
    Route::get('getRoles', 'Admin\RolesController@getRoles');


    Route::resource('galleries', 'ImageGalleryController');

    Route::resource('rooms', 'Admin\RoomController');
    Route::get('getRooms', 'Admin\RoomController@getRooms');

    Route::resource('testimonials', 'Admin\TestimonialController');
    Route::get('getTestimonies', 'Admin\TestimonialController@getTestimonies');

    Route::resource('places', 'Admin\PlacesController');
    Route::get('getPlaces', 'Admin\PlacesController@getPlaces');

    Route::resource('services', 'Admin\ServicesController');
    Route::get('getServices', 'Admin\ServicesController@getServices');

    Route::resource('booking','Admin\RoomBookingController');
    Route::get('getBookedRoom','Admin\RoomBookingController@getBookedRoom');

    Route::get('/images/latest', 'ImageGalleryController@getLatestImage')->name('latest.image');
    Route::get('/images/search/{searchTerm}', 'ImageGalleryController@searchImage')->name('images.search');

});
});
