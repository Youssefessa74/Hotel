<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Hotel;
use App\Models\Titles;
use App\Models\WhatWeOffer;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $hotel = Hotel::orderBy('id', 'desc')->take(3)->get();
        $apartment = Apartment::where('status',1)
        ->withAvg('ratings', 'rating') // Calculate average rating
        ->get();
        $what_we_offer = WhatWeOffer::orderBy('id','desc')->take(6)->get();
        $titles = Titles::whereIn('key', $this->titles())->get()->pluck('value', 'key');
        return view('frontend.index', compact('hotel','apartment','titles','what_we_offer')); // Pass the variable to the view
    }

}
