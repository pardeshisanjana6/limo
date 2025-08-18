@extends('admin.adminlayout') 

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Vehicles for Brand: {{ $brand->name }}</h1>

    @if ($vehicles->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No vehicles found for {{ $brand->name }}.
        </div>
    @else
        <div class="row">
            @foreach ($vehicles as $vehicle)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($vehicle->image_path) }}" class="card-img-top" alt="{{ $vehicle->vehicle_title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vehicle->vehicle_title }}</h5>
                        <p class="card-text mb-1">
                            <strong>Price:</strong> ₹{{ number_format($vehicle->price_per_day, 2) }} / day
                        </p>
                        <p class="card-text mb-1">
                            <strong>Fuel:</strong> {{ $vehicle->fuel_type }}
                        </p>
                        <p class="card-text mb-1">
                            <strong>Seats:</strong> {{ $vehicle->seating_capacity }}
                        </p>

                        <div class="mt-3">
                            <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE') {{-- This tells Laravel it's a DELETE request --}}
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the vehicle: {{ $vehicle->vehicle_title }}? This action cannot be undone.');">Delete</button>
                            </form>
                            {{-- Optional: Add an Edit button if you have an edit route for vehicles --}}
                            {{-- <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-info btn-sm ms-2">Edit</a> --}}
                        </div>
                        {{-- <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="btn btn-info btn-sm mt-3">View Full Details</a> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $vehicles->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection