@extends('admin.adminlayout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Vehicle: {{ $vehicle->vehicle_title }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vehicle Details</h6>
        </div>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="card-body">
            <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="vehicle_title">Vehicle Title</label>
                    <input type="text" class="form-control" id="vehicle_title" name="vehicle_title" value="{{ old('vehicle_title', $vehicle->vehicle_title) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select class="form-control" id="brand_id" name="brand_id" required>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id', $vehicle->brand_id) == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="price_per_day">Price per Day</label>
                    <input type="number" class="form-control" id="price_per_day" name="price_per_day" value="{{ old('price_per_day', $vehicle->price_per_day) }}" required>
                </div>

                <div class="form-group">
                    <label for="fuel_type">Fuel Type</label>
                    <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="{{ old('fuel_type', $vehicle->fuel_type) }}" required>
                </div>
                
                <div class="form-group">
    <label for="model_year">Model Year</label>
    <input type="number" class="form-control" id="model_year" name="model_year" value="{{ old('model_year', $vehicle->model_year) }}" required>
</div>

<div class="form-group">
    <label for="seating_capacity">Seating Capacity</label>
    <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" value="{{ old('seating_capacity', $vehicle->seating_capacity) }}" required>
</div>

                <div class="form-group">
                    <label for="image_path">Current Image</label>
                    <div class="mb-2">
                        <img src="{{ asset($vehicle->image_path) }}" alt="{{ $vehicle->vehicle_title }}" style="max-height: 150px;">
                    </div>
                    <label for="image_path">Upload New Image (optional)</label>
                    <input type="file" class="form-control-file" id="image_path" name="image_path">
                </div>

                <button type="submit" class="btn btn-primary">Update Vehicle</button>
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection