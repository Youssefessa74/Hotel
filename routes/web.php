<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function(){
    Route::get('/user-home', [UserController::class, 'index'])->name('user.dashboard');
});
Route::controller(PagesController::class)->group(function(){
    Route::get('hotel-room/{id}','HotelRooms')->name('hotel_rooms');
    Route::get('hotel-room-details/{id}','RoomDetails')->name('room_details');
    Route::get('service','Service')->name('service');
    Route::get('about','About')->name('about');
    Route::get('contact','Contact')->name('contact');
    Route::post('contact-mail-form','ContactMailForm')->name('contact_mail_form');
    Route::post('subscribe','Subscribe')->name('subscribe.route');

});

Route::controller(PaymentController::class)->group(function(){
    Route::post('make-payment','MakePayment')->name('make_payment');
    // this middleware forbidden users to type the link and access it directly
   Route::middleware('check_for_payment')->group(function(){
     // Payment with Paypal Route
     Route::get('pay-with-paypal','PayWithPaypal')->name('pay_with_paypal');
     // Payment Success Page
     Route::get('payment-success','PaymentSuccess')->name('payment_success');


   });
   Route::delete('/bookings/cancel/{id}','cancelBooking')->name('bookings.cancel');
   Route::post('apartment-rate',[PagesController::class,'Apartment_rate'])->name('apartment_rate');

});

Route::controller(UserController::class)->group(function(){
    Route::get('my-bookings','MyBookings')->name('my_bookings')->middleware('auth:web');
    Route::post('delete-booking/{id}','DeleteBooking')->name('bookings.destroy')->middleware('auth:web');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

