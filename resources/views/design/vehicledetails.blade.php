@extends('users.userlayout')

@section('content')
<br><br>
<section class="vehicle-details-section py-5">
    <div class="container">
        @if (session('status'))
            <div class="alert alert-info" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                
                <img src="{{ asset($vehicle->image_path) }}" class="img-fluid rounded shadow-sm" alt="{{ $vehicle->vehicle_title }}">
            </div>
            <div class="col-md-6">
                <h1 class="mb-3">{{ $vehicle->vehicle_title }}</h1>
                <p class="lead">{{ $vehicle->brand->name ?? 'N/A' }}</p>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>Price per Day:</strong> ₹<span id="daily-rate">{{ $vehicle->price_per_day }}</span></li>
                    <li class="list-group-item"><strong>Seating Capacity:</strong> {{ $vehicle->seating_capacity }}</li>
                    <li class="list-group-item"><strong>Fuel Type:</strong> {{ ucfirst($vehicle->fuel_type) }}</li>
                    <li class="list-group-item"><strong>Model Year:</strong> {{ $vehicle->model_year ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Mileage:</strong> {{ $vehicle->mileage ?? 'N/A' }} km</li>
                    <li class="list-group-item"><strong>Description:</strong> {{ $vehicle->vehicle_overview ?? 'No description provided.' }}</li>
                </ul>
                @if (isset($isAvailable) && !$isAvailable)
                    <div class="alert alert-danger">
                        This vehicle is not available for the dates selected ({{ $pickupDate }} to {{ $dropoffDate }}).
                    </div>
                @else
                    <a href="{{ route('booking.form', ['vehicle' => $vehicle->id, 'pickup_date' => $pickupDate, 'dropoff_date' => $dropoffDate]) }}" class="btn btn-primary btn-lg">Proceed to Booking</a>
                @endif

                
            </div>
        </div><br>
    </div>
</section>

@endsection