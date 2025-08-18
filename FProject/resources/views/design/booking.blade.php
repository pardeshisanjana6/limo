@extends('users.userlayout')

@section('content')
<br><br><br>
<section class="container py-5">
    <h2 class="text-center mb-4">My Bookings</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    @if($bookings->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            You don't have any bookings yet.
            <a href="{{ route('cars') }}" class="alert-link">Explore Vehicles</a>
        </div>
    @else
        @foreach($bookings as $booking)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Booking ID: {{ $booking->id }}</h4>
                    <div class="row mb-3"> 
                        <div class="col-md-12">
                            <p class="mb-1">
                                <strong>Vehicle:</strong> {{ optional(optional($booking->vehicle)->brand)->name ?? 'N/A' }} -
                                {{ optional($booking->vehicle)->vehicle_title ?? 'N/A' }} ({{ optional($booking->vehicle)->model_year ?? 'N/A' }})
                            </p>
                            <p class="mb-1">
                                <strong>Dates:</strong> {{ \Carbon\Carbon::parse($booking->pickup_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($booking->pickup_time)->format('h:i A') }} to
                                {{ \Carbon\Carbon::parse($booking->dropoff_date)->format('M d, Y') }}
                            </p>
                            <p class="mb-1">
                                <strong>Total:</strong> <span class="fw-bold text-success">₹{{ number_format($booking->total_amount, 2) }}</span>
                                <span class="mx-2">|</span> 
                                <strong>Customer:</strong> {{ $booking->customer_name ?? 'N/A' }} ({{ $booking->customer_mobile ?? 'N/A' }})
                            </p>
                        </div>
                    </div>
                    <hr class="my-3"> 
                    <div class="d-flex justify-content-between align-items-center">
                </div>
                <div>
                    <strong>Status:</strong>
                        @if($booking->status === 'confirmed')
                            <span class="badge bg-success fs-6">Confirmed</span>
                            @elseif($booking->status === 'pending')
                                <span class="badge bg-warning text-dark fs-6">Pending</span>
                            @elseif($booking->status === 'cancelled')
                                <span class="badge bg-danger fs-6">Cancelled</span>
                            @elseif($booking->status === 'completed')
                                <span class="badge bg-primary fs-6">Completed</span>
                            @else
                                <span class="badge bg-secondary fs-6">{{ ucfirst($booking->status) }}</span>
                        @endif

                        @if(isset($booking->payment_status))
                        <br>
                            <strong>Payment Status:</strong>
                            @if($booking->payment_status === 'paid')
                                <span class="badge bg-success fs-6">Completed</span>
                                @elseif($booking->payment_status === 'pending')
                                    <span class="badge bg-warning text-dark fs-6">Pending</span>
                                @else
                                    <span class="badge bg-secondary fs-6">{{ ucfirst($booking->payment_status) }}</span>
                            @endif
                        @endif
                
                    @if($booking->status === 'pending' || ($booking->status === 'confirmed' && $booking->payment_status !== 'paid'))
                        <a href="{{ route('users.payment', $booking->id) }}" class="btn btn-primary btn-lg">
                            Proceed to Payment
                        </a>
                        <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to cancel this booking?');">
                                Cancel Booking
                            </button>
                        </form>
                    @elseif($booking->status === 'confirmed' && $booking->payment_status === 'paid')
                        <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to cancel this booking?');">
                                Cancel Booking
                            </button>
                        </form>
                    @elseif($booking->status === 'cancelled')
                        <form action="{{ route('bookings.reconfirm', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg" onclick="return confirm('Are you sure you want to re-confirm this booking?');">
                                Re-confirm Booking
                            </button>
                        </form>
                    @elseif($booking->status === 'completed')
                        <button class="btn btn-success btn-lg" disabled>Booking Completed</button>
                    @endif   
                </div> 
            </div>
        @endforeach
    @endif
</section>
@endsection