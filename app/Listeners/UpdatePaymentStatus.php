<?php

namespace App\Listeners;

use App\Events\PaymentCompleted;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePaymentStatus
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
     */
    public function handle(PaymentCompleted $event)
    {
        // Find the booking and update payment status
        $booking = Booking::find($event->bookingId);
        if ($booking) {
            $booking->update(['payment_status' => 'done']);
        }
}
}
