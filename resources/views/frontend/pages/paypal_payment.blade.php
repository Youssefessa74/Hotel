@extends('layouts.app')

@section('content')
    <div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <script
            src="https://www.paypal.com/sdk/js?client-id={{ $settings['paypal_client_id'] }}&currency={{ $settings['paypal_currency'] }}">
        </script>
        <div id="paypal-button-container"></div>
        <script>
            paypal.Buttons({
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '{{ Session::get('price') }}'
                            }
                        }],
                        application_context: {
                            shipping_preference: 'NO_SHIPPING'
                        }
                    });
                },
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {
                        // Send booking_id and PayPal sale ID to your backend
                        window.location.href = '{{ route("payment_success") }}?booking_id={{ $bookingId }}&paypal_sale_id=' + orderData.id;
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </div>
@endsection
