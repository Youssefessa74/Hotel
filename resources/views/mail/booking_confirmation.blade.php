<!-- resources/views/emails/booking_confirmation.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p>Hi {{ $booking->name }},</p>
    <p>Thank you for booking with us!</p>
    <p>Here are your booking details:</p>
    <ul>
        <li>Check-in: {{ $booking->check_in }}</li>
        <li>Check-out: {{ $booking->check_out }}</li>
        <li>Number of Days: {{ $booking->days }}</li>
        <li>Price: ${{ $booking->price }}</li>
    </ul>
    <p>If you have any questions, please contact us.</p>
</body>
</html>
