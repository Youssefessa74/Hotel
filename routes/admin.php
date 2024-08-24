<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\AmenitiesController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\NewLettersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WhatWeOffer;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth', 'checkAdminOrHigher:2','admin'])->group(function () {

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


// Profile Routes
Route::controller(ProfileController::class)->group(function(){
    Route::get('admin-profile-all','index')->name('admin_profile');
    Route::post('edit-profile','EditProfile')->name('admin.profile.edit');
    Route::post('admin-change-password','changePassword')->name('admin.change_password');
   });


// Hotel Routes
Route::controller(HotelController::class)->group(function(){
    Route::get('all-hotels','index')->name('all_hotels');
    Route::get('create-hotel','create')->name('create_hotels');
    Route::post('store-hotel','store')->name('store_hotels');
    Route::get('edit-hotel/{id}','edit')->name('edit_hotels');
    Route::post('store-hotel/{id}','update')->name('update_hotels');
    Route::get('delete-hotel/{id}','destory')->name('destory_hotels');
   });


   // Contact Routes
Route::controller(ContactController::class)->group(function(){
    Route::get('contacts','index')->name('contacts');
    Route::post('store-contact','store')->name('store_contacts');
    Route::put('contact-title','Contact_titles')->name('contact_titles');
   });

      // Testimonials Routes
Route::controller(TestimonialController::class)->group(function(){
    Route::get('testimonials','index')->name('testimonials');
    Route::get('create-testimonials','create')->name('testimonials.create');
    Route::post('store-testimonials','store')->name('testimonials.store');
    Route::get('edit-testimonials/{id}','edit')->name('testimonials.edit');
    Route::put('update-testimonials/{id}','update')->name('testimonials.update');
    Route::get('delete-testimonials/{id}','destroy')->name('testimonials.delete');

   });


      // NewsLetters Routes
Route::controller(NewLettersController::class)->group(function(){
    Route::get('new-letters','index')->name('news_letters');
    Route::get('delete-subscribers/{id}','destroy')->name('delete_subscribers');
    Route::post('send-news-letters','SendNewsLetters')->name('send_news_letters');

   });


   // Amenities Routes
Route::controller(AmenitiesController::class)->group(function(){
    Route::get('all-amenities','index')->name('all_amenities');
     Route::get('create-amenitie','create')->name('create_amenities');
     Route::post('store-amenitie','store')->name('store_amenities');
     Route::get('delete-amenitie/{id}','destory')->name('destory_amenities');
   });

   // Apartments Routes
   Route::resource('apartments',ApartmentController::class);
   Route::get('apartment-delete/{id}',[ApartmentController::class,'delete_apartment'])->name('delete_apartment');


   // Services Routes
   Route::controller(ServiceController::class)->group(function(){
    Route::get('all-services','index')->name('service_index');
    Route::get('create-service','create')->name('service_create');
    Route::post('store-service','store')->name('service_store');
    Route::get('edit-service/{id}','edit')->name('service_edit');
    Route::put('update-service/{id}','update')->name('service_update');
   });

   // What We Offer Routes

   Route::controller(WhatWeOffer::class)->group(function(){
    Route::get('all-offers','index')->name('offer_index');
    Route::get('offer-create','create')->name('offer_create');
    Route::post('offer-store','store')->name('offer_store');
    Route::get('offer-delete/{id}','destroy')->name('offer_delete');
    Route::put('what-we-offer-titles','WhatWeOfferTitles')->name('what_we_offer_titles');
   });

     // Settings Routes

     Route::controller(SettingsController::class)->group(function(){
        Route::get('all-settings','index')->name('settings');
        Route::post('paypal-update','update')->name('paypal_update');
       });

        // Booking Routes

     Route::controller(BookingsController::class)->group(function(){
        Route::get('bookings','index')->name('bookings');
        Route::get('pending-bookings','PendingBookings')->name('pending_bookings');
        Route::get('confirmed-bookings','ConfirmedBookings')->name('confirmed_bookings');
        Route::get('completed-bookings','CompletedBookings')->name('completed_bookings');
        Route::get('canceled-bookings','CanceledBookings')->name('canceled_bookings');
        Route::get('bookings-all-data/{id}','show_all_data')->name('show_all_data');
        Route::post('update-booking-status/{id}','update_booking_status')->name('update_booking_status');
        Route::post('send-booking-details/{bookingId}','sendBookingDetails')->name('send_booking_details');
       });


        // Admins Routes

        Route::middleware('checkAdminOrHigher:4')->group(function(){
            Route::get('all-admins',[AdminsController::class,'index'])->name('all.admins');
            Route::get('create-admins',[AdminsController::class,'create'])->name('create.admins');
            Route::post('store-admins',[AdminsController::class,'store'])->name('store.admins');
            Route::get('edit/{id}-admins',[AdminsController::class,'edit'])->name('edit.admins');
            Route::put('update/{id}-admins',[AdminsController::class,'update'])->name('update.admins');
            Route::get('delete/{id}-admins',[AdminsController::class,'delete'])->name('delete.admins');

        });

  });



