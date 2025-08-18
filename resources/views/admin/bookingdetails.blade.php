@extends('admin.adminlayout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Booking Details (ID: {{ $booking->id }})</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div id="status-message" role="alert"></div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Booking Information</h6>
                </div>
                <div class="card-body">
                    <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
                    <p>
                        <strong>Status:</strong>
                        <span id="booking-status" data-field="status" contenteditable="true" style="border-bottom: 1px dotted #000; cursor: pointer;">
                            {{ $booking->status }}
                        </span>
                    </p>
                    <p>
                        <strong>Total Amount:</strong>
                        <span id="booking-total-amount">₹{{ number_format($booking->total_amount, 2) }}</span>
                    </p>
                    <p><strong>Booked On:</strong> {{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y H:i A') }}</p>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Information</h6>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong>
                        <span id="customer-name" data-field="customer_name" contenteditable="true" style="border-bottom: 1px dotted #000; cursor: pointer;">
                            {{ $booking->customer_name }}
                        </span>
                    </p>
                    <p><strong>Email:</strong>
                        <span id="customer-email" data-field="customer_email" contenteditable="true" style="border-bottom: 1px dotted #000; cursor: pointer;">
                            {{ $booking->customer_email }}
                        </span>
                    </p>
                    <p><strong>Mobile:</strong>
                        <span id="customer-mobile" data-field="customer_mobile" contenteditable="true" style="border-bottom: 1px dotted #000; cursor: pointer;">
                            {{ $booking->customer_mobile ?? 'N/A' }}
                        </span>
                    </p>
                    <p><strong>Address:</strong>
                        <span id="customer-address" data-field="customer_address" contenteditable="true" style="border-bottom: 1px dotted #000; cursor: pointer;">
                            {{ $booking->customer_address ?? 'N/A' }}
                        </span>
                    </p>
                    @if ($booking->user)
                        <p><strong>Registered User:</strong> {{ $booking->user->name }} (ID: {{ $booking->user->id }})</p>
                    @else
                        <p><strong>Registered User:</strong> Guest Booking (User account may have been deleted)</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Vehicle Information</h6>
                </div>
                <div class="card-body text-center">
                    @if ($booking->vehicle)
                        <img src="{{ asset($booking->vehicle->image_path) }}" class="img-fluid rounded mb-3" alt="{{ $booking->vehicle->vehicle_title }}" style="max-height: 200px; object-fit: cover;">
                        <h5>{{ $booking->vehicle->brand->name ?? 'N/A' }} - {{ $booking->vehicle->vehicle_title }}</h5>
                        <ul class="list-group list-group-flush text-left">
                            <li class="list-group-item"><strong>Model Year:</strong> {{ $booking->vehicle->model_year ?? 'N/A' }}</li>
                            <li class="list-group-item"><strong>Price per Day:</strong> ₹{{ $booking->vehicle->price_per_day }}</li>
                            <li class="list-group-item"><strong>Seating Capacity:</strong> {{ $booking->vehicle->seating_capacity }}</li>
                            <li class="list-group-item"><strong>Fuel Type:</strong> {{ ucfirst($booking->vehicle->fuel_type) }}</li>
                        </ul>
                    @else
                        <p class="text-danger">Vehicle not found (may have been deleted).</p>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rental Dates & Time</h6>
                </div>
                <div class="card-body">
                    <p>
                        <strong>Pickup Date:</strong>
                        <span id="pickup-date" data-field="pickup_date" contenteditable="true" style="border-bottom: 1px dotted #000; cursor: pointer;">
                            {{ \Carbon\Carbon::parse($booking->pickup_date)->format('Y-m-d') }}
                        </span>
                    </p>
                    <p>
                        <strong>Drop-off Date:</strong>
                        <span id="dropoff-date" data-field="dropoff_date" contenteditable="true" style="border-bottom: 1px dotted #000; cursor: pointer;">
                            {{ \Carbon\Carbon::parse($booking->dropoff_date)->format('Y-m-d') }}
                        </span>
                    </p>
                    <p><strong>Pickup Time:</strong> {{ \Carbon\Carbon::parse($booking->pickup_time)->format('h:i A') }}</p>
                    @php
                    // Use Carbon to correctly calculate the difference in days
                    $pickupDate = \Carbon\Carbon::parse($booking->pickup_date);
                    $dropoffDate = \Carbon\Carbon::parse($booking->dropoff_date);
                    $rentalDays = $pickupDate->diffInDays($dropoffDate);

                    // If the pickup and drop-off dates are the same, the duration is 1 day.
                    if ($rentalDays === 0) {
                        $rentalDays = 1;
                    }
                    @endphp
                    <p><strong>Rental Duration:</strong> <span id="rental-duration">{{ $rentalDays }} day(s)</span></p>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary mb-4">Back to Bookings List</a>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editableFields = document.querySelectorAll('[contenteditable="true"]');
        const bookingId = {{ $booking->id }};
        const statusMessage = document.getElementById('status-message');

        editableFields.forEach(field => {
            field.dataset.originalValue = field.innerText.trim();

            field.addEventListener('blur', function () {
                const fieldName = this.getAttribute('data-field');
                let newValue = this.innerText.trim();
                const originalValue = this.dataset.originalValue;

                if (fieldName === 'pickup_date' || fieldName === 'dropoff_date') {
                    const date = new Date(newValue);
                    if (!isNaN(date)) {
                        newValue = date.toISOString().split('T')[0];
                        this.innerText = newValue;
                    } else {
                        this.innerText = originalValue;
                        statusMessage.className = 'alert alert-danger';
                        statusMessage.innerText = 'Invalid date format. Please use YYYY-MM-DD.';
                        return; 
                    }
                }
                
                if (newValue !== originalValue) {
                    console.log('Value has changed. Sending fetch request...');

                    const postData = {
                        field: fieldName,
                        value: newValue,
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    };
                    
                    fetch('{{ route('admin.bookings.update', $booking->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify(postData)
                    })
                    .then(response => {
                        if (!response.ok) {
                            
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(result => {
                        if (result.success) {
                            statusMessage.className = 'alert alert-success';
                            statusMessage.innerText = result.message || 'Booking updated successfully.';
                            this.dataset.originalValue = newValue;

                            if (fieldName === 'pickup_date' || fieldName === 'dropoff_date') {
                                const pickupDate = new Date(document.getElementById('pickup-date').innerText);
                                const dropoffDate = new Date(document.getElementById('dropoff-date').innerText);
                                const diffTime = Math.abs(dropoffDate - pickupDate);
                                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                                diffDays = diffDays === 0 ? 1 : diffDays;
                                
                                document.getElementById('rental-duration').innerText = diffDays + ' day(s)';
                            }

                            
                            if (result.total_amount !== undefined) {
                                document.getElementById('booking-total-amount').innerText = '₹' + result.total_amount.toLocaleString('en-IN');
                            }
                        } else {
                            
                            this.innerText = originalValue;
                            statusMessage.className = 'alert alert-danger';
                            statusMessage.innerText = result.message || 'Failed to update booking.';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        let errorMessage = 'An unexpected error occurred.';
                        if (error.errors) {
                            errorMessage = Object.values(error.errors).flat().join(' ');
                        } else if (error.message) {
                            errorMessage = error.message;
                        }
                        statusMessage.className = 'alert alert-danger';
                        statusMessage.innerText = 'Error: ' + errorMessage;
                        this.innerText = originalValue; 
                    });
                }
            });
        });
    });
</script>
@endsection