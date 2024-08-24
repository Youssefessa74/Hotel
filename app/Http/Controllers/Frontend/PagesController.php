<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Amenities;
use App\Models\Apartment;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Rating;
use App\Models\Service;
use App\Models\Subscriber;
use App\Models\Testimonial;
use App\Models\Titles;
use App\Models\WhatWeOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PagesController extends Controller
{
    public function HotelRooms($id)
    {
        $apartment = Apartment::where(['status' => 1, 'hotel_id' => $id])->get();
        return view('frontend.pages.rooms', compact('apartment'));
    }
    public function RoomDetails($id)
    {
        $room = Apartment::findOrFail($id);
        return view('frontend.pages.room_details', compact('room'));
    }

    public function titles()
    {
        $keys = [
            'what_we_offer_title',
            'what_we_offer_first_description',
            'what_we_offer_second_description',
            'what_we_offer_image',
            'what_we_offer_image_old_image',
            'contact_title',
            'contact_description',
            'contact_button_title'
        ];
        return $keys;
    }

    public function About()
    {
        $titles = Titles::whereIn('key', $this->titles())->get()->pluck('value', 'key');
        $what_we_offer = WhatWeOffer::orderBy('id', 'desc')->take(6)->get();
        $services = Service::orderBy('id', 'desc')->where('status', 1)->take(3)->get();
        $testimonials = Testimonial::orderBy('id', 'desc')->where('status', 1)->take(6)->get();
        return view('frontend.pages.about', compact('services', 'what_we_offer', 'titles','testimonials'));
    }

    public function Service()
    {
        $amenities = Amenities::orderBy('id', 'desc')->take(8)->get();
        $services = Service::orderBy('id', 'desc')->where('status', 1)->take(3)->get();
        return view('frontend.pages.service', compact('services', 'amenities'));
    }

    public function Contact()
    {
        $contact = Contact::first();
        $titles = Titles::whereIn('key', $this->titles())->get()->pluck('value', 'key');
        return view('frontend.pages.contact', compact('contact', 'titles'));
    }


    public function ContactMailForm(Request $request)
    {
        // Define the validation rules
        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'max:500'],
            'message' => ['required', 'max:1000'],
        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors as a JSON response with a 422 status code
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Proceed with the rest of your logic if validation passes
        // For example, you could send an email here

        Mail::send(new ContactMail($request->name, $request->email, $request->subject, $request->message));
        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully!'
        ]);
    }

    public function Subscribe(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email', 'unique:subscribers,email']
            ], [
                'email.unique' => 'This email is already subscribed.'
            ]);
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();

            return response(['status' => 'success', 'message' => 'You have subscribed with us.'], 200);
        } catch (ValidationException $e) {
            Log::error('Validation Exception:', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            Log::error('Unexpected Exception:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response(['status' => 'error', 'message' => 'An unexpected error occurred.'], 500);
        }
    }

    public function Apartment_rate(Request $request)
    {
        $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        $apartmentId = $request->apartment_id;

        // Check if the user has completed a booking for this apartment
        $hasBooked = Booking::where('user_id', $user->id)
            ->where('apartment_id', $apartmentId)
            ->where('booking_status', 'completed')
            ->exists();

        if (!$hasBooked) {
            // Log the error
            Log::error('User attempted to review an apartment without a completed booking.', [
                'user_id' => $user->id,
                'apartment_id' => $apartmentId,
            ]);
            // Return error response
            return response()->json([
                'status' => 'error',
                'message' => 'You can only review apartments you have stayed in.',
            ]);
        }

        $already_reviewed = Rating::where('user_id', $user->id)
            ->where('apartment_id', $apartmentId)
            ->exists();

        if ($already_reviewed) {
            // Log the error
            Log::error('User IS Already Reviewed.', [
                'user_id' => $user->id,
                'apartment_id' => $apartmentId,
            ]);



            // Return error response
            return response()->json([
                'status' => 'error',
                'message' => 'You Already Reviewed This Room.',
            ]);
        }

        $review = new Rating();
        $review->apartment_id = $apartmentId;
        $review->user_id = $request->user_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Thanks for your review!',
        ], 200);
    }
}
