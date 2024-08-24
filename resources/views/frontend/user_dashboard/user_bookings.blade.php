@extends('layouts.app')
@section('content')
    <style>
        .table-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 1000px;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            display: inline-block;
            padding: 10px 20px;
            font-size: 10px;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .no-bookings-container {
            text-align: center;
            margin-top: 20px;
        }

        .no-bookings-message {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .no-bookings-button {
            display: inline-block;
        }

        /* Status color classes */
        .status-pending {
            color: #ffc107;
            /* Yellow */
            font-weight: bold;
        }

        .status-confirmed {
            color: #28a745;
            /* Green */
            font-weight: bold;
        }

        .status-completed {
            color: #17a2b8;
            /* Light Blue or another color */
            font-weight: bold;
        }

        .status-canceled {
            color: #dc3545;
            /* Red */
            font-weight: bold;
        }
        .delete-p-canceled {
            color: #dc3545;
            /* Red */
            font-weight: bold;
        }
    </style>

    @if ($bookings->isEmpty())
        <div class="no-bookings-container">
            <p class="no-bookings-message">You have no bookings.</p>
            <a href="{{ url('/') }}" class="btn btn-primary no-bookings-button">Go Home</a>
        </div>
    @else
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Price</th>
                            <th>Hotel</th>
                            <th>Apartment</th>
                            <th>Booking Status</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr id="booking-row-{{ $booking->id }}">
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->check_in }}</td>
                                <td>{{ $booking->check_out }}</td>
                                <td>${{ number_format($booking->price, 2) }}</td>
                                <td>{{ $booking->hotel->name }}</td>
                                <td>{{ $booking->apartment->name }}</td>
                                <td class="{{ 'status-' . strtolower($booking->booking_status) }}">
                                    {{ ucfirst($booking->booking_status) }}
                                </td>
                                @if ($booking->booking_status == 'completed' || $booking->booking_status == 'cancel')
                                    <td>
                                        <form class="delete-form" action="{{ route('bookings.destroy', $booking->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete Booking</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <p class="delete-p-canceled">You Can't Delete unless the book canceled or completed</p>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var url = form.attr('action'); // Get the action URL for the form

                // Show confirmation dialog
                if (confirm('Are you sure you want to cancel this booking?')) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: form.serialize(), // Serialize form data
                        success: function(response) {
                            // Apply slide-up animation before removing the row
                            form.closest('tr').fadeOut(400, function() {
                                $(this).remove();
                            });
                            toastr.success(response
                            .message); // Ensure toastr is loaded and used for notifications
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the booking.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
@endsection
