<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Titles;
use App\Models\WhatWeOffer;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function titles(){
        $keys = [
            'what_we_offer_title',
            'what_we_offer_first_description',
            'what_we_offer_second_description',
            'what_we_offer_image',
            'what_we_offer_image_old_image'
        ];
        return $keys;
    }
    public function index()
    {

        $titles = Titles::whereIn('key', $this->titles())->get()->pluck('value', 'key');
        $hotel = Hotel::orderBy('id', 'desc')->take(3)->get();
        $apartment = Apartment::where('status',1)->get();
        $what_we_offer = WhatWeOffer::orderBy('id','desc')->take(6)->get();
        return view('frontend.index', compact('hotel','apartment','titles','what_we_offer'));
    }
    public function MyBookings()
    {
        $bookings = Booking::with(['apartment', 'hotel'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('id','DESC')->get();

        return view('frontend.user_dashboard.user_bookings', compact('bookings'));
    }

    public function DeleteBooking($id){
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return response(['success'=>1,'message'=>'Booking Deleted Successfully'],200);
    }

}
