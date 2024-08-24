<?php

namespace App\Http\Controllers\Frontend;

use App\Events\PaymentCompleted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingValidation;
use App\Models\Booking;
use App\Models\Setting;
use App\Services\Book;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PayPal\Api\Amount;
use PayPal\Api\Refund;
use PayPal\Api\Sale;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Core\PayPalHttpConfig;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_CLIENT_SECRET')
            )
        );

        $this->apiContext->setConfig([
            'mode' => env('PAYPAL_MODE', 'sandbox'),
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE',
            'cache.enabled' => true,
        ]);
    }

    public function makePayment(BookingValidation $request, Book $book)
    {
        try {
            // Check if the user is authenticated
            $userId = auth()->check() ? auth()->id() : null;

            // Create booking, passing user ID if available
            $booking = $book->create_booking($request, $userId);

            // Store the booking ID in the session or directly pass to view
            session(['booking_id' => $booking->id]);


            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully!',
                'booking' => $booking,
                'redirect_url' => route('pay_with_paypal') // Optional: return booking details if needed
            ]);
        } catch (\Exception $e) {
            // Log the exception message and stack trace
            Log::error('Error creating booking: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the booking.',
            ], 500);
        }
    }



    public function PayWithPaypal()
    {
        // Retrieve PayPal settings from the database
        $keys = ['paypal_client_id', 'paypal_currency'];
        $settings = Setting::whereIn('key', $keys)->pluck('value', 'key');

        // Retrieve the booking ID from the session
        $bookingId = session('booking_id');

        // Return the view with settings and booking ID
        return view('frontend.pages.paypal_payment', [
            'bookingId' => $bookingId,
            'settings' => $settings
        ]);
    }


    public function PaymentSuccess(Request $request)
    {
        $bookingId = $request->input('booking_id');

        // Validate the booking ID
        $booking = Booking::find($bookingId);
        if (!$booking) {
            return redirect()->route('home')->with('error', 'Invalid booking.');
        }

        try {
            // Trigger the PaymentCompleted event
            PaymentCompleted::dispatch($bookingId);

            // Store the PayPal sale ID (if available in the request)
            $paypalSaleId = $request->input('paypal_sale_id'); // Ensure this is being sent by PayPal
            if ($paypalSaleId) {
                $booking->paypal_sale_id = $paypalSaleId;
                $booking->save();
            }

            // Clear session or other post-payment logic
            session()->forget('price');
            session()->forget('booking_id');

            return view('frontend.pages.payment_success');
        } catch (\Exception $e) {
            Log::error('Payment Success Error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred during payment confirmation.');
        }
    }


    public function cancelBooking($id)
    {

        $booking = Booking::find($id);

        if (!$booking || $booking->payment_status !== 'done') {
            return redirect()->back()->with('error', 'Booking cannot be cancelled.');
        }

        $paypalSaleId = $booking->paypal_sale_id;

        if ($this->refundPayment($paypalSaleId, $booking->price)) {
            $booking->booking_status = 'cancel';
            $booking->refund_status = 'done';
            $booking->save();

            return redirect()->back()->with('success', 'Booking cancelled and refund processed.');
        } else {
            return redirect()->back()->with('error', 'Failed to process refund.');
        }
    }
    private function refundPayment($saleId, $amount)
    {
        $currencyCode = Setting::where('key', 'paypal_currency')->value('value');
        $accessToken = 'A21AAI51voxuWH6fS1zr1iZeXwDG2_pSGmHKRtE0VktujtS-EoA0f_LaP9t5QrclZiumfr15-YaIRSVxEajhEX2xDWUQoUjFA';

        $client = new Client();

        try {
            $response = $client->post("https://api.sandbox.paypal.com/v1/payments/sale/{$saleId}/refund", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'amount' => [
                        'total' => $amount,
                        'currency' => $currencyCode,
                    ],
                ],
            ]);

            $responseBody = json_decode($response->getBody(), true);

            // Log the entire response for debugging
            Log::info('PayPal Refund Response:', ['response' => $responseBody]);

            // Check if the refund was successful
            if (isset($responseBody['state']) && $responseBody['state'] === 'completed') {
                return true;
            } else {
                Log::error('Refund Failed - Response State:', ['state' => $responseBody['state'] ?? 'unknown']);
                Log::error('Refund Failed - Full Response:', ['response' => $responseBody]);
                return false;
            }
        } catch (\Exception $ex) {
            // Log detailed error information
            Log::error('PayPal Refund Error:', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);
            return false;
        }
    }

}
