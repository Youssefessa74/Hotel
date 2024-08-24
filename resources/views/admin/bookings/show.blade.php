@extends('admin.body.dashboard')
@section('content')
    <div id="print_card" class="card">
        <div class="card-body">
            <div class="container-fluid d-flex justify-content-between">
                <div class="col-lg-3 ps-0">

                    <a style="margin: 25px" class="btn btn-inverse-primary" href="{{ route('bookings') }}">All Bookings</a>
                    <a href="#" class="noble-ui-logo logo-light d-block mt-3">Hotel<span>Booking</span></a>
                    <h5 class="mt-5 mb-2 text-muted">Booking for :</h5>
                    <p>{{ $booking->name }},<br> {{ $booking->email }}<br> {{ $booking->phone }}</p>
                </div>
                <div class="col-lg-3 pe-0">
                    <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">Booking</h4>
                    <h6 class="text-end mb-5 pb-4"># {{ $booking->id }}</h6>
                    <p class="text-end mb-1">Booking Status</p>
                    <h4 class="text-end fw-normal">{{ $booking->status }}</h4>

                    <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Check-in Date :</span>
                        {{ $booking->check_in }}</h6>
                    <h6 class="text-end fw-normal"><span class="text-muted">Check-out Date :</span>
                        {{ $booking->check_out }}</h6>
                </div>
            </div>

            <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                <div class="table-responsive w-100">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hotel</th>
                                <th>Apartment</th>
                                <th>Days</th>
                                <th class="text-end">Price per Night</th>
                                <th class="text-end">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-end">
                                <td class="text-start">1</td>
                                <td class="text-start">{{ $booking->hotel->name }}</td>
                                <td class="text-start">{{ $booking->apartment->name }}</td>
                                <td class="text-start">{{ $booking->days }}</td>
                                <td>{{ number_format($booking->price / $booking->days, 2) }}</td>
                                <td>{{ number_format($booking->price, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container-fluid mt-5 w-100">
                <div class="row">
                    <div class="col-md-6 ms-auto d-print-none">
                        <div class="col-lg-8">
                            <div class="col-md-8 d-print-none">
                                <form action="{{ route('update_booking_status', $booking->id) }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="">Booking Status</label>
                                        <select class="form-control" name="booking_status" id="">
                                            <option @selected($booking->booking_status === 'pending') value="pending">Pending</option>
                                            <option @selected($booking->booking_status === 'confirmed') value="confirmed">Confirmed</option>
                                            <option @selected($booking->booking_status === 'completed') value="completed">Completed</option>
                                            <option @selected($booking->booking_status === 'canceled') value="canceled">Canceled</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ms-auto">
                        <h2>Booking Summary</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Price per Night</td>
                                        <td class="text-end">${{ number_format($booking->price / $booking->days, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Price</td>
                                        <td class="text-end">${{ number_format($booking->price, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid w-100">
                <a href="javascript:;" id="booking_send_mail" class="btn btn-primary float-end mt-4 ms-2 d-print-none" data-booking-id="{{ $booking->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send me-3 icon-md">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>Send Booking Details
                </a>

                <a id="print_button" href="javascript:;" class="btn btn-outline-primary float-end mt-4 d-print-none"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-printer me-2 icon-md">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>Print</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
     $(document).ready(function() {
    $('#booking_send_mail').on('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will send booking details to the user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, send it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Assume you have booking ID in a data attribute or can retrieve it
                var bookingId = $(this).data('booking-id');

                // Disable the button and show the spinner
                var button = $(this);
                button.prop('disabled', true);
                button.text('Sending...');

                $.ajax({
                    method: 'POST',
                    url:'{{ route("send_booking_details", ":bookingId") }}'.replace(':bookingId',bookingId),
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire(
                            'Sent!',
                            'Booking details have been sent.',
                            'success'
                        );
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'Something went wrong. Please try again.',
                            'error'
                        );
                    },
                    complete: function() {
                        // Re-enable the button
                        button.prop('disabled', false);
                        button.text('Send Booking Details');
                    }
                });
            }
        });
    });
});



        $(document).ready(function() {
            $('#print_button').on('click', function() {
                let printContents = $('#print_card').html();
                let printWindow = window.open('', '', 'width=600,height=600');
                printWindow.document.open();
                printWindow.document.write('<html>');
                printWindow.document.write(
                    '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"'
                );
                printWindow.document.write('<body>');
                printWindow.document.write(printContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();

                printWindow.print();
                printWindow.close();
            });
        })
    </script>
@endpush
