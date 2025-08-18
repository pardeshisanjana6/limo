@extends('users.userlayout')
@section('content')
<section id="hero" class="position-relative jarallax" style="
        background-image: url(images/Bg.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
      ">
    <div class="container-fluid">
      <div class="hero-content container justify-content-center text-center">
        <div class="row">
          <div class="detail mb-4">
            <h1 class="text-white">Find Your Car & Limousine</h1>
            <p class="hero-paragraph text-white">
              We have many best rental car collections.
            </p>
          </div>
        </div>
      </div>
    </div>

<section id="search position-absolute top-50 start-50 translate-middle">
      <div class="container search-block p-5">
        <form id="searchForm" action="{{ route('cars') }}" method="GET" class="row">
          <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
            <label for="vehicle" class="label-style text-capitalize form-label text-white">Vehicle type</label>
            <div class="input-group date">
              <select class="form-select form-control p-3" id="vehicle" aria-label="Default select example"
                style="background-image: none">
                <option selected>Select Vehicle Type</option>
                <option value="1">All</option>
                <option value="2">2 Seater</option>
                <option value="3">4 Seater</option>
                <option value="4">6 Seater</option>
                <option value="5">7 Seater</option>
              </select>
              <span class="search-icon-position position-absolute p-3">
                <iconify-icon class="search-icons" icon="solar:bus-outline"></iconify-icon>
              </span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
            <label for="location" class="label-style text-capitalize form-label text-white">Picking up location</label>
            
            <div class="input-group location text-dark">
              <input type="text" class="form-control p-3 position-relative" placeholder="Airport or anywhere" id="location" name="location">
              <span class="search-icon-position position-absolute p-3">
                <iconify-icon class="search-icons" icon="solar:map-arrow-square-outline"></iconify-icon>
              </span>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
    <label for="pick-up-date" class="label-style text-capitalize form-label text-white">Picking up date</label>
    <div class="input-group date" id="datepicker1">
        <input type="text" class="form-control p-3" id="pick-up-date-input" name="pickup_date" placeholder="Select Date" required />
        <span class="input-group-append">
            <span class="search-icon-position position-absolute p-3">
                <iconify-icon class="search-icons" icon="solar:calendar-broken"></iconify-icon>
            </span>
        </span>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
    <label for="return-date" class="label-style text-capitalize form-label text-white">Returning date</label>
    <div class="input-group date" id="datepicker2">
        <input type="text" class="form-control p-3" id="return-date-input" name="dropoff_date" placeholder="Select Date" required />
        <span class="input-group-append">
            <span class="search-icon-position position-absolute p-3">
                <iconify-icon class="search-icons" icon="solar:calendar-broken"></iconify-icon>
            </span>
        </span>
    </div>
</div>
        
          <div class="d-grid gap-2 mt-4">
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary" type="button">Find your car</a>
            @endguest
            @auth
                <button type="submit" class="btn btn-primary">Find your car</button>
            @endauth
          </div>
        </form>
      </div>
    </section>
  </section>
<br>

<section id="card">
    <div class="container">
      <h2 class="text-uppercase text-center text-dark"><br>
        great cars rental & Limousine Services
      </h2>
      <h3 class="text-center">{{ $pageTitle }}</h3>
      <div class="row">
        @forelse ($vehicles as $vehicle)
            <div class="col-md-6 col-lg-4">
                <div class="post pt-5 pb-3">
                    <div class="image-zoom">
                        <a href="{{ route('vehicle.details', $vehicle->id) }}" class="blog-img">
                            <img src="{{ asset($vehicle->image_path) }}" alt="{{ $vehicle->vehicle_title }}" class="img-fluid" />
                        </a>
                    </div>
                    <div class="text-center text-dark text-uppercase">
                        <a href="{{ route('vehicle.details', ['vehicle' => $vehicle->id]) }}">
                            <h4>{{ $vehicle->brand->name ?? 'N/A' }}</h4>
                            <p><b>{{ $vehicle->vehicle_title }}</b></p>
                        </a>
                        <p class="text-center m-0 p-0">Starts from <b> ₹{{ number_format($vehicle->price_per_day, 2) }}/day</b></p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No vehicles are available for the selected dates.
                </div>
            </div>
        @endforelse
      </div>
    </div>
  </section>
<br><br><br>
@endsection