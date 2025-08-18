<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Redirect;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessfulMail;

class PaymentController extends Controller
{
    public function index(Booking $booking)
    {
        $amount = $booking->total_amount;
        $amountInPaise = $amount * 100;
    
        if ($amountInPaise < 100) {
            return redirect()->back()->with('error', 'The order amount is too low. The minimum is ₹1.00.');
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $orderData = [
            'receipt'         => 'booking_rcptid_' . $booking->id,
            'amount'          => $amountInPaise, 
            'currency'        => 'INR',
            'payment_capture' => 1,
            'notes'           => [
                'booking_id' => $booking->id
            ]
        ];

        $razorpayOrder = $api->order->create($orderData);

        return view('users.payment', compact('razorpayOrder', 'booking'));
    }

    public function payment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $attributes = [
            'razorpay_order_id'   => $request->input('razorpay_order_id'),
            'razorpay_payment_id' => $request->input('razorpay_payment_id'),
            'razorpay_signature'  => $request->input('razorpay_signature')
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);
            $payment = $api->payment->fetch($attributes['razorpay_payment_id']);
            $bookingId = null;
        
            if (isset($payment->notes) && isset($payment->notes['booking_id'])) {
                $bookingId = $payment->notes['booking_id'];
            } else {
                $orderId = $attributes['razorpay_order_id'];
                $order = $api->order->fetch($orderId);
                $receipt = $order->receipt;
                if (strpos($receipt, 'booking_rcptid_') === 0) {
                    $bookingId = substr($receipt, 15);
                }
            }

            $booking = Booking::find($bookingId);

            if ($booking) {
                $booking->payment_status = 'paid';
                $booking->save();
                 Mail::to($booking->customer_email)->send(new PaymentSuccessfulMail($booking));
                return redirect()->route('my.bookings')->with('success', 'Payment successful!');
            }

            } catch (\Exception $e) {
                return redirect()->route('my.bookings')->with('error', 'Payment verification failed: ' . $e->getMessage());
            }

        return redirect()->route('my.bookings')->with('error', 'Booking not found after successful payment. Please contact support.');
    }

    public function adminIndex()
    {
        $bookings = Booking::with('vehicle', 'user')->get();

        return view('admin.payment', compact('bookings'));
    }

    public function updateStatusForCancelledBooking(Booking $booking)
    {
        $booking->payment_status = 'not applicable';
        $booking->save();
    }


}
