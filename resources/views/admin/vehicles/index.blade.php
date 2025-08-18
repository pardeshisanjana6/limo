@extends('admin.adminlayout') 

@section('title', 'Manage Vehicles')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container-fluid">
    <h2 class="mb-4">Manage Vehicles</h2>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">VEHICLE DETAILS</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Vehicle Title</th>
                            <th>Brand</th>
                            <th>Price per day (₹)</th>
                            <th>Fuel Type</th>
                            <th>Model Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    @if($vehicles->isEmpty())
        <tr>
            <td colspan="7" class="text-center">No vehicles found.</td>
        </tr>
    @else
        @php $cnt = 1; @endphp 
        @foreach($vehicles as $vehicle)
            <tr>
                <td>{{ $cnt++ }}</td> 
                <td>{{ $vehicle->vehicle_title }}</td>
                <td>{{ $vehicle->brand->name }}</td> 
                <td>{{ $vehicle->price_per_day }}</td>
                <td>{{ $vehicle->fuel_type }}</td>
                <td>{{ $vehicle->model_year }}</td>
                <td>
                    
                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE') 
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vehicle?');">
        <i class="fas fa-trash-alt"></i>
    </button>
</form>

                </td>
            </tr>
        @endforeach
    @endif
</tbody>
                </table>

                

            </div>
        </div>
    </div>
</div>
@endsection