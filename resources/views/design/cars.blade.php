@extends('users.userlayout')
@section('content')
<section id="gallery" class="padding-small">
    <div class="container mb-5 pb-5">
        <h2 class="text-uppercase text-center text-dark">find by type</h2>

        <div class="mb-4 text-center">
            <p>
                <button
                    class="filter-button text-secondary btn btn-light border border-secondary-subtle rounded-0 px-4 py-1 me-2 mb-3 text-capitalize active"
                    data-filter="*">
                    All
                </button>
                @foreach ($allFuelTypes as $fuelType)
                    <button
                        class="filter-button text-secondary btn btn-light border border-secondary-subtle rounded-0 px-4 py-1 me-2 mb-3 text-capitalize"
                        data-filter=".{{ strtolower($fuelType) }}">
                        {{ $fuelType }}
                    </button>
                @endforeach
            </p>
        </div>

        <div class="isotope-container">
            @if($vehicles->isEmpty())
                <div class="col-12 text-center">
                    <p class="alert alert-info">No vehicles available at the moment matching your criteria. Please check back later!</p>
                </div>
            @else
                @foreach($vehicles as $vehicle)
                    <div class="col-md-3 item {{ strtolower($vehicle->fuel_type) }} seating-{{ $vehicle->seating_capacity }} p-2">
                        <a href="{{ route('vehicle.details', ['vehicle' => $vehicle->id, 'pickup_date' => $pickupDate ?? null, 'dropoff_date' => $dropoffDate ?? null]) }}" 
                           title="{{ $vehicle->vehicle_title }}" 
                           class="image-link">
                            <img src="{{ asset($vehicle->image_path) }}" class="post-image img-fluid" alt="{{ $vehicle->vehicle_title }}" />
                            <div class="types mt-2">
                                <h4 class="text-center text-uppercase m-0 text-dark">{{ $vehicle->brand->name ?? 'N/A' }}</h4>
                                <p class="text-center m-0 p-0">
                                    <b>{{ $vehicle->vehicle_title }}</b><br>
                                    Starts from : <b> ₹{{ $vehicle->price_per_day }}/day</b>
                                </p>
                                <div class="d-flex justify-content-center">
                                    <a 
                                        href="{{ route('vehicle.details', ['vehicle' => $vehicle->id, 'pickup_date' => $pickupDate ?? null, 'dropoff_date' => $dropoffDate ?? null]) }}" 
                                        class="btn-underline mt-2 mb-2 text-uppercase fw-bold" 
                                        style="font-size: 14px">
                                        Rent now
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection