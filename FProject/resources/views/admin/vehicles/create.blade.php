@extends('admin.adminlayout')

@section('title', 'Post A Vehicle')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Post A Vehicle</h2>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">BASIC INFO</h6>
        </div>
        <div class="card-body">
            {{-- Display success or error messages that come via session flash data --}}
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

            <form action="{{route('admin.vehicles.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="vehicle_title" class="form-label">Vehicle Title*</label>
                        {{-- Add is-invalid class if there's an error for this field --}}
                        <input type="text" class="form-control @error('vehicle_title') is-invalid @enderror" id="vehicle_title" name="vehicle_title" required value="{{ old('vehicle_title') }}">
                        {{-- Display the validation error message --}}
                        @error('vehicle_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="brand_id" class="form-label">Select Brand*</label>
                        {{-- Add is-invalid class if there's an error for this field --}}
                        <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id" required>
                            <option value="">Select</option>
                            {{-- Loop through brands passed from the controller --}}
                            @foreach($brands as $brand)
                                {{-- Use old() to re-select the option if validation fails --}}
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        {{-- Display the validation error message --}}
                        @error('brand_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="vehicle_overview" class="form-label">Vehicle Overview*</label>
                    <textarea class="form-control @error('vehicle_overview') is-invalid @enderror" id="vehicle_overview" name="vehicle_overview" rows="3" required>{{ old('vehicle_overview') }}</textarea>
                    @error('vehicle_overview')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price_per_day" class="form-label">Price Per Day (₹)*</label>
                        <input type="number" class="form-control @error('price_per_day') is-invalid @enderror" id="price_per_day" name="price_per_day" required value="{{ old('price_per_day') }}">
                        @error('price_per_day')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fuel_type" class="form-label">Select Fuel Type*</label>
                        <select class="form-select @error('fuel_type') is-invalid @enderror" id="fuel_type" name="fuel_type" required>
                            <option value="">Select</option>
                            <option value="petrol" {{ old('fuel_type') == 'petrol' ? 'selected' : '' }}>Petrol</option>
                            <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="electric" {{ old('fuel_type') == 'electric' ? 'selected' : '' }}>Electric</option>
                        </select>
                        @error('fuel_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="model_year" class="form-label">Model Year*</label>
                        <input type="number" class="form-control @error('model_year') is-invalid @enderror" id="model_year" name="model_year" required value="{{ old('model_year') }}">
                        @error('model_year')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="seating_capacity" class="form-label">Seating Capacity*</label>
                        <input type="number" class="form-control @error('seating_capacity') is-invalid @enderror" id="seating_capacity" name="seating_capacity" required value="{{ old('seating_capacity') }}">
                        @error('seating_capacity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <h6 class="m-0 font-weight-bold text-primary mt-4">Upload Images</h6>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-sm-6 mb-3">
                        <label for="image" class="form-label">Image*</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <h6 class="m-0 font-weight-bold text-primary mt-4">ACCESSORIES</h6>
                <hr>
                <div class="row">
                    {{-- General error for the accessories array if something unexpected happened --}}
                    @error('accessories')
                        <div class="text-danger mb-2">{{ $message }}</div>
                    @enderror

                    {{-- For checkboxes, you usually don't need individual @error for each unless specific validation on each --}}
                    {{-- but ensure 'accessories.*' is validated in controller to catch non-string values --}}
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            {{-- Check old input for checkboxes to maintain state after validation error --}}
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Air Conditioner" id="air_conditioner" {{ is_array(old('accessories')) && in_array('Air Conditioner', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="air_conditioner">Air Conditioner</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Power Door Locks" id="power_door_locks" {{ is_array(old('accessories')) && in_array('Power Door Locks', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="power_door_locks">Power Door Locks</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="AntiLock Braking System" id="antilock_braking_system" {{ is_array(old('accessories')) && in_array('AntiLock Braking System', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="antilock_braking_system">AntiLock Braking System</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Brake Assist" id="brake_assist" {{ is_array(old('accessories')) && in_array('Brake Assist', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="brake_assist">Brake Assist</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Power Steering" id="power_steering" {{ is_array(old('accessories')) && in_array('Power Steering', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="power_steering">Power Steering</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Driver Airbag" id="driver_airbag" {{ is_array(old('accessories')) && in_array('Driver Airbag', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="driver_airbag">Driver Airbag</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Passenger Airbag" id="passenger_airbag" {{ is_array(old('accessories')) && in_array('Passenger Airbag', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="passenger_airbag">Passenger Airbag</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Power Windows" id="power_windows" {{ is_array(old('accessories')) && in_array('Power Windows', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="power_windows">Power Windows</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="CD Player" id="cd_player" {{ is_array(old('accessories')) && in_array('CD Player', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cd_player">CD Player</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Central Locking" id="central_locking" {{ is_array(old('accessories')) && in_array('Central Locking', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="central_locking">Central Locking</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Crash Sensor" id="crash_sensor" {{ is_array(old('accessories')) && in_array('Crash Sensor', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="crash_sensor">Crash Sensor</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="Leather Seats" id="leather_seats" {{ is_array(old('accessories')) && in_array('Leather Seats', old('accessories')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="leather_seats">Leather Seats</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary px-4">Add Vehicle</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection