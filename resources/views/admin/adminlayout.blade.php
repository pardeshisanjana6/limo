<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; 
            display: flex; 
            min-height: 100vh;
            margin: 0;
        }

        #wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar-wrapper {
            min-width: 250px; 
            max-width: 250px;
            background-color: #9E8464;
            color: white;
            position: sticky;
            top: 0;
            height: 100vh; 
            padding-top: 20px;
            transition: margin .25s ease-out; 
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            font-weight: bold;
            border-bottom: 1px solid #9E8464;
            margin-bottom: 20px;
        }

        #sidebar-wrapper .list-group {
            width: 100%;
        }

        #sidebar-wrapper .list-group-item {
            background-color: transparent;
            color: #e6edf4ff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: #495057;
            color: #ffffff;
            text-decoration: none;
        }

        #sidebar-wrapper .list-group-item.active {
            background-color: black; 
            color: white;
        }

        #page-content-wrapper {
            width: 100%;
            padding: 20px;
        }

        .top-bar {
            background-color: #9E8464;
            border-bottom: 1px solid #e2e6ea;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .top-bar .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color:white;
        }

        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-left: -250px; 
            }
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0; 
            }
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }
            .top-bar .account-dropdown {
                margin-top: 10px;
            }
        }
    </style>
    @yield('head_scripts')
</head>
<body>

    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">Car Rental Portal | Admin Panel</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action @if(Request::routeIs('admin.dashboard')) active @endif">Dashboard</a>
                <a href="{{ route('admin.brands.index') }}" class="list-group-item list-group-item-action @if(Request::routeIs('admin.brands.index')) active @endif">Brands</a>

                <div class="list-group-item list-group-item-action p-0  @if(Request::routeIs('admin.vehicles.create')) active @endif @if(Request::routeIs('admin.vehicles.index')) active @endif">
                    <a href="#vehiclesSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Vehicles
                    </a>
                    <ul class="collapse list-unstyled mb-0" id="vehiclesSubmenu">
                        <li>
                            <a href="{{ route('admin.vehicles.create')}}" class="list-group-item list-group-item-action ps-4 @if(Request::routeIs('admin.vehicles.create')) active @endif">Add Vehicle</a>
                        </li>
                        <li>
                            <a href="{{route('admin.vehicles.index')}}" class="list-group-item list-group-item-action ps-4">Manage Vehicles</a>
                        </li>
                    </ul>
                </div>
                <a href="{{ route('admin.bookings.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center @if(Request::routeIs('admin.bookings.index')) active @endif">
                    Bookings
                </a>
                
                <a href="#" class="list-group-item list-group-item-action">Manage Testimonials</a>
                <a href="{{ route('admin.admin.contact') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center @if(Request::routeIs('admin.admin.contact')) active @endif">Manage Contact Query</a>
                <a href="{{route('admin.users.index')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center @if(Request::routeIs('admin.users.index')) active @endif">Reg Users</a>
                <a href="{{route('admin.admin.payments')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center @if(Request::routeIs('admin.admin.payments')) active @endif">Payments</a>
                <a href="#" class="list-group-item list-group-item-action">Update Contact Info</a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="top-bar">
                <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
                <div class="account-dropdown">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                            @auth('admin')
                                <li><span class="dropdown-item-text">{{ Auth::guard('admin')->user()->name }}</span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>

        </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    
</body>
</html>