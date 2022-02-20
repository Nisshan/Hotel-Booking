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

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlacesController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\RoomBookingController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SiteController;
use App\Http\Controllers\ImageGalleryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::redirect('/admin', 'login');


Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/available', [SearchController::class,'search'])->name('available.rooms');
Route::post('/available', [SearchController::class,'search'])->name('rooms.available');
Route::get('/rooms', [SiteController::class,'rooms'])->name('rooms');
Route::get('/services', [SiteController::class,'services'])->name('services');
Route::get('/places', [SiteController::class,'places'])->name('places');
Route::get('/rooms/{room_no}', [SiteController::class,'singleRoom'])->name('single.room');
Route::get('/places/{name}', [SiteController::class,'visitPlace'])->name('single.place');
Route::get('/service/{name}', [SiteController::class,'servicePage'])->name('single.service');


Route::resource('bookingroom', BookingController::class);

Route::group(['prefix' => 'admin/'], function () {
    Auth::routes();
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::get('getUsers', [UserController::class,'getUsers']);

        Route::resource('roles', RolesController::class);
        Route::get('getRoles', [RolesController::class,'getRoles']);


        Route::resource('galleries', ImageGalleryController::class);

        Route::resource('rooms', RoomController::class);
        Route::get('getRooms', [RoomController::class,'getRooms']);

        Route::resource('testimonials', TestimonialController::class);
        Route::get('getTestimonies', [TestimonialController::class,'getTestimonies']);

        Route::resource('places', PlacesController::class);
        Route::get('getPlaces', [PlacesController::class,'getPlaces']);

        Route::resource('services', ServicesController::class);
        Route::get('getServices', [ServicesController::class,'getServices']);

        Route::resource('booking', RoomBookingController::class);
        Route::get('getBookedRoom', [RoomBookingController::class,'getBookedRoom']);

        Route::get('/images/latest', [ImageGalleryController::class,'getLatestImage'])->name('latest.image');
        Route::get('/images/search/{searchTerm}', [ImageGalleryController::class,'searchImage'])->name('images.search');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
