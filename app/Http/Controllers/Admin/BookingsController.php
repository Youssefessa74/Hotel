<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BookingDataTable;
use App\DataTables\CancledBookingsDataTable;
use App\DataTables\CompletedBookingsDataTable;
use App\DataTables\ConfirmedBookingsDataTable;
use App\DataTables\PendingBookingsDataTable;
use App\Events\BookingStatusUpdated;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingsController extends Controller
{
    public function index(BookingDataTable $bookingDataTable)
    {
        return $bookingDataTable->render('admin.bookings.index');
    }
    public function PendingBookings(PendingBookingsDataTable $bookingDataTable)
    {
        return $bookingDataTable->render('admin.bookings.pending_bookings');
    }

    public function ConfirmedBookings(ConfirmedBookingsDataTable $bookingDataTable)
    {
        return $bookingDataTable->render('admin.bookings.confirmed_bookings');
    }

    public function CompletedBookings(CompletedBookingsDataTable $bookingDataTable)
    {
        return $bookingDataTable->render('admin.bookings.completed_bookings');
    }
    public function CanceledBookings(CancledBookingsDataTable $bookingDataTable)
    {
        return $bookingDataTable->render('admin.bookings.canceled_bookings');
    }



    public function show_all_data($id)
    {

        // Retrieve the booking by ID
        $booking = Booking::findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    public function update_booking_status($id ,Request $request){
        $booking = Booking::findOrFail($id);
        $booking->booking_status = $request->booking_status;
        $booking->save();
        toastr('Booking Status Updated Successfully');
        return redirect()->back();
    }

//     public function update(Request $request, Booking $booking)
//     {
//         $booking->update($request->all());

//         // Dispatch BookingConfirmed event
//         event(new BookingConfirmed);
//         toastr('Booking Mail Sent Successfully');
//         return redirect()->back();
// }


        public function sendBookingDetails($bookingId)
        {
            try {
                $booking = Booking::findOrFail($bookingId);
                BookingStatusUpdated::dispatch($booking);
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                // Log the error message
                Log::error('Failed to send booking details', [
                    'booking_id' => $bookingId,
                    'error_message' => $e->getMessage(),
                    'stack_trace' => $e->getTraceAsString(),
                ]);

                return response()->json(['success' => false, 'message' => 'Something went wrong.']);
            }
        }
}
