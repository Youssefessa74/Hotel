<?php

namespace App\Listeners;

use App\Events\BookingStatusUpdated;
use App\Mail\BookingStatusUpdatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingDetailsEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */ public function handle(BookingStatusUpdated $event)
    {
        // Send the email
        Mail::to($event->booking->email)->send(new BookingStatusUpdatedMail($event->booking));
    }
}
