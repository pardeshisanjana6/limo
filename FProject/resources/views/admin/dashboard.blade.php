@extends('admin.adminlayout') 

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{route('admin.users.index')}}" class="card border-left-primary shadow h-100 py-2 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">REG USERS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $regUsersCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            
            <a href="{{ route('admin.vehicles.index') }}" class="card border-left-success shadow h-100 py-2 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">TOTAL VEHICLES</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $listedVehiclesCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            
            <a href="{{ route('admin.bookings.index') }}" class="card border-left-info shadow h-100 py-2 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">TOTAL BOOKINGS</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalBookingsCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('admin.brands.index') }}" class="card border-left-warning shadow h-100 py-2 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">LISTED BRANDS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $listedBrandsCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
    <a href="{{ route('admin.admin.contact') }}" class="card border-left-primary shadow h-100 py-2 text-decoration-none">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TOTAL QUERIES</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalQueries }}</div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-phone fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('admin.admin.payments') }}" class="card border-left-warning shadow h-100 py-2 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">PAYMENTS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $paymentCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        

    </div>
</div>
@endsection