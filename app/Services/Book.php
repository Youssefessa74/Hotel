<?php

namespace App\Services;

use App\Http\Requests\Frontend\BookingValidation;
use App\Mail\BookingConfirmation;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class Book
{
    public function create_booking(BookingValidation $request, $userId = null)
    {
        // Calculate the number of days between check_in and check_out
        $checkIn = Carbon::parse($request->input('check_in'));
        $checkOut = Carbon::parse($request->input('check_out'));
        $days = $checkOut->diffInDays($checkIn);
        $price = $request->price * $days;
        $total_price = $days * $price;
        session()->put('price', $total_price);

        // Create and save the booking
        $booking = Booking::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'check_in' => $checkIn->format('Y-m-d'),
            'check_out' => $checkOut->format('Y-m-d'),
            'days' => $days,
            'price' => $price,
            'user_id' => $userId,
            'apartment_id' => $request->input('apartment_id'),
            'hotel_id' => $request->input('hotel_id'),
        ]);

        // Send confirmation email
        Mail::to($booking->email)->send(new BookingConfirmation($booking));
        return $booking; // Return the created booking instance or any other success indication
    }
}
