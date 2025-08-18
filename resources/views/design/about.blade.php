@extends('users.userlayout') 
@section('Car Rental Services')
@section('content')

  <section id="about-hero" class="position-relative jarallax" style="
        background-image: url({{ asset('images/aboutback.jpg') }});
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
      ">
    <div class="container-fluid">
      <div class="hero-content container justify-content-center text-center">
        <div class="row">
          <div class="detail mb-4">
            <h1 class="text-white">About Us</h1>
            <p class="hero-paragraph text-white">
              Learn more about our car rental and limousine services.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="our-story" class="padding-small" style="margin-top: -40px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <img src="{{ asset('images/about1.jpg') }}" alt="Our Story" class="img-fluid">
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
          <h2 class="text-dark">Our Story & Mission</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
          <p>
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
          <ul class="list-unstyled">
            <li><iconify-icon icon="ic:check"></iconify-icon> Wide range of luxury vehicles</li>
            <li><iconify-icon icon="ic:check"></iconify-icon> Professional and courteous chauffeurs</li>
            <li><iconify-icon icon="ic:check"></iconify-icon> 24/7 customer support</li>
            <li><iconify-icon icon="ic:check"></iconify-icon> Competitive pricing</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="services" class="bg-light">
    <div class="container padding-small text-center">
      <div class="row justify-content-center text-center text-md-start g-4">
        <div class="col-lg-3 col-md-6">
          <div class="services">
            <svg class="services-icon" width="50" height="50">
              <use xlink:href="#car"></use>
            </svg>
          </div>
          <p class="fw-bold text-dark mb-0">Choose a vehicle</p>
          <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="services">
            <svg class="services-icon" width="50" height="50">
              <use xlink:href="#bookmark"></use>
            </svg>
          </div>
          <p class="fw-bold text-dark mb-0">Pick location & date</p>
          <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="services">
            <svg class="services-icon" width="50" height="50">
              <use xlink:href="#money"></use>
            </svg>
          </div>
          <p class="fw-bold text-dark mb-0">Book your car</p>
          <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="services">
            <svg class="services-icon" width="50" height="50">
              <use xlink:href="#comment"></use>
            </svg>
          </div>
          <p class="fw-bold text-dark mb-0">Finish process</p>
          <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('body_scripts')
@endsection