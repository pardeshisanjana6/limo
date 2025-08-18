@extends('users.userlayout')
@section('content')

<section id="blog" class="padding-small pt-7">
    <h2 class="text-dark text-center my-5">
      Our Recent Posts
    </h2>
    <div class="container">
      <div class="row g-3">
        <div class="col-lg-4 col-12"><a href="#"><img src="images/blog1.jpg" alt="" class="img-fluid">
            <p class="text-secondary mb-0"> Feb 22, 2023 / Tips</p>
            <h4>Safest car rental services in 2023</h4>
          </a></div>

        <div class="col-lg-4 col-12"><a href="#"><img src="images/blog2.jpg" alt="" class="img-fluid">
            <p class="text-secondary mb-0"> Feb 22, 2023 / Tips</p>
            <h4>Best car collection in the world</h4>
          </a></div>

        <div class="col-lg-4 col-12"><a href="#"><img src="images/blog3.jpg" alt="" class="img-fluid">
            <p class="text-secondary mb-0"> Feb 22, 2023 / Information</p>
            <h4>Which car is the best for travel</h4>
          </a></div>
      </div>
      <div class="blog-btn text-center mt-5"><button class="btn btn-dark rounded-0 text-uppercase"> Read blogs</button></div>
    </div>
  </section>
  
  @endsection