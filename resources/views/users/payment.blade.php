@extends('users.userlayout')

@section('content')
<br><br><br><br>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="container text-center">
    <div class="card p-4 mx-auto" style="max-width: 500px;">
        <h2 class="mb-2">Complete Your Payment</h2>
        <p class="h4">Your total amount is: <strong class="text-success">₹{{ number_format($booking->total_amount, 2) }}</strong></p>
        <p class="mb-4">Click the button below to complete the payment.</p>

        <form action="{{ route('payment.success') }}" method="POST">
            @csrf
            <script
                src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ env('RAZORPAY_KEY') }}"
                data-amount="{{ $razorpayOrder['amount'] }}"
                data-currency="INR"
                data-order_id="{{ $razorpayOrder['id'] }}"
                data-buttontext="Pay Now"
                data-name="Test Company"
                data-description="Booking ID: {{ $booking->id }}"
                data-image="https://your-logo-url.com/logo.png"
                data-prefill.name="{{ Auth::user()->name }}"
                data-prefill.email="{{ Auth::user()->email }}"
                data-theme.color="#007bff">
            </script>
        </form>
    </div>
</div>
<br><br><br>
@endsection