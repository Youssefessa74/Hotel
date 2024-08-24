<!DOCTYPE html>
<html>
<head>
    <title>Your Booking Is Confirmed</title>
</head>
<body>
    <h1>Your Booking Is Confirmed Successfully</h1>
   <p>Dear {{ $name }},</p>
    <p>Your booking has been updated. Here are the details:</p>
    <ul>
        <li>Check-in: {{ $check_in }}</li>
        <li>Check-out: {{ $check_out }}</li>
        <li>Price: ${{ $price }}</li>
    </ul>
    <p>You can come and honor us in {{ $check_in }}</p>
    <p>Thank you for booking with us!</p>
</body>
</html>
