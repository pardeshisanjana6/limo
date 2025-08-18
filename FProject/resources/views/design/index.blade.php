<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Limo - Free Bootstrap Website Template for Car Rental</title>

  <!--vendor css ================================================== -->
  <link rel="stylesheet" type="text/css" href="css/vendor.css" />

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

  <!--Bootstrap ================================================== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

  <!-- Style Sheet ================================================== -->
  <link rel="stylesheet" type="text/css" href="css/style.css" />

  <!-- Google Fonts ================================================== -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

  <!-- script ================================================== -->
  <script src="js/modernizr.js"></script>
</head>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="time" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 2.75a9.25 9.25 0 1 0 0 18.5a9.25 9.25 0 0 0 0-18.5M1.25 12C1.25 6.063 6.063 1.25 12 1.25S22.75 6.063 22.75 12S17.937 22.75 12 22.75S1.25 17.937 1.25 12M12 7.25a.75.75 0 0 1 .75.75v3.69l2.28 2.28a.75.75 0 1 1-1.06 1.06l-2.5-2.5a.75.75 0 0 1-.22-.53V8a.75.75 0 0 1 .75-.75" clip-rule="evenodd"/></symbol>
  <symbol id="call" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M4.718 3.092c1.226-1.291 3.254-1.05 4.268.384l1.26 1.784c.811 1.147.743 2.74-.225 3.76l-.245.257l-.002.006c-.013.036-.045.152-.013.372c.067.455.418 1.381 1.846 2.884c1.432 1.508 2.3 1.863 2.703 1.929a.6.6 0 0 0 .294-.007l.408-.43c.874-.92 2.236-1.101 3.335-.469l1.91 1.1c1.633.94 2.013 3.239.708 4.613l-1.42 1.495c-.443.467-1.048.866-1.795.94c-1.824.18-6.049-.055-10.478-4.719c-4.134-4.351-4.919-8.136-5.018-9.985l.666-.036l-.666.036c-.049-.914.358-1.697.894-2.262zm3.043 1.25c-.512-.724-1.433-.768-1.956-.217l-1.57 1.652c-.33.35-.505.75-.483 1.149c.08 1.51.731 4.952 4.607 9.032c4.064 4.28 7.809 4.4 9.244 4.259c.283-.028.575-.186.854-.48l1.42-1.495c.614-.646.453-1.808-.368-2.28l-1.91-1.1c-.513-.295-1.114-.204-1.499.202l-.456.48l-.527-.501c.527.5.527.501.526.502l-.001.001l-.003.004l-.007.006l-.014.014a1 1 0 0 1-.136.112c-.08.056-.186.119-.321.172c-.276.109-.64.167-1.091.094c-.878-.142-2.028-.773-3.55-2.376c-1.528-1.608-2.113-2.807-2.243-3.7c-.067-.454-.014-.817.084-1.092a1.6 1.6 0 0 1 .23-.427l.03-.037l.014-.015l.006-.007l.003-.003l.002-.001s0-.002.533.503l-.532-.505l.287-.302c.445-.469.51-1.263.088-1.86z" clip-rule="evenodd"/><path fill="currentColor" d="M13.26 1.88a.75.75 0 0 1 .861-.62c.025.005.107.02.15.03q.129.027.352.09c.297.087.712.23 1.21.458c.996.457 2.321 1.256 3.697 2.631c1.376 1.376 2.175 2.702 2.632 3.698c.228.498.37.912.457 1.21a6 6 0 0 1 .113.454l.005.031a.765.765 0 0 1-.617.878a.75.75 0 0 1-.86-.617a3 3 0 0 0-.081-.327a7.4 7.4 0 0 0-.38-1.004c-.39-.85-1.092-2.024-2.33-3.262s-2.411-1.939-3.262-2.329a7.4 7.4 0 0 0-1.003-.38a6 6 0 0 0-.318-.08a.76.76 0 0 1-.626-.861"/><path fill="currentColor" fill-rule="evenodd" d="M13.486 5.33a.75.75 0 0 1 .927-.516l-.206.721l.207-.72h.002l.004.001l.007.002l.02.007q.023.006.057.019q.067.023.177.07c.145.062.344.158.589.303c.49.29 1.157.77 1.942 1.556c.785.785 1.267 1.453 1.556 1.942c.145.245.241.444.304.59a3 3 0 0 1 .089.233l.006.02l.002.008l.001.003v.002l-.72.207l.721-.206a.75.75 0 0 1-1.44.422l-.003-.01l-.035-.088a4 4 0 0 0-.216-.417c-.223-.376-.625-.946-1.325-1.646s-1.27-1.102-1.646-1.325a4 4 0 0 0-.504-.25l-.01-.004a.75.75 0 0 1-.506-.925" clip-rule="evenodd"/></symbol>
    <symbol id="location" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3.25 10.143C3.25 5.244 7.155 1.25 12 1.25s8.75 3.994 8.75 8.893c0 2.365-.674 4.905-1.866 7.099c-1.19 2.191-2.928 4.095-5.103 5.112a4.2 4.2 0 0 1-3.562 0c-2.175-1.017-3.913-2.92-5.103-5.112c-1.192-2.194-1.866-4.734-1.866-7.099M12 2.75c-3.992 0-7.25 3.297-7.25 7.393c0 2.097.603 4.392 1.684 6.383c1.082 1.993 2.612 3.624 4.42 4.469a2.7 2.7 0 0 0 2.291 0c1.809-.845 3.339-2.476 4.421-4.469c1.081-1.99 1.684-4.286 1.684-6.383c0-4.096-3.258-7.393-7.25-7.393m0 5a2.25 2.25 0 1 0 0 4.5a2.25 2.25 0 0 0 0-4.5M8.25 10a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0" clip-rule="evenodd"/></symbol>
  <!-- <symbol id="location" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3.25 10.143C3.25 5.244 7.155 1.25 12 1.25s8.75 3.994 8.75 8.893c0 2.365-.674 4.905-1.866 7.099c-1.19 2.191-2.928 4.095-5.103 5.112a4.2 4.2 0 0 1-3.562 0c-2.175-1.017-3.913-2.92-5.103-5.112c-1.192-2.194-1.866-4.734-1.866-7.099M12 2.75c-3.992 0-7.25 3.297-7.25 7.393c0 2.097.603 4.392 1.684 6.383c1.082 1.993 2.612 3.624 4.42 4.469a2.7 2.7 0 0 0 2.291 0c1.809-.845 3.339-2.476 4.421-4.469c1.081-1.99 1.684-4.286 1.684-6.383c0-4.096-3.258-7.393-7.25-7.393m0 5a2.25 2.25 0 1 0 0 4.5a2.25 2.25 0 0 0 0-4.5M8.25 10a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0" clip-rule="evenodd"/></symbol> -->
 <symbol id="car" viewBox="0 0 256 256"><path fill="currentColor" d="M240 104h-10.8l-27.78-62.5A16 16 0 0 0 186.8 32H69.2a16 16 0 0 0-14.62 9.5L26.8 104H16a8 8 0 0 0 0 16h8v80a16 16 0 0 0 16 16h24a16 16 0 0 0 16-16v-16h96v16a16 16 0 0 0 16 16h24a16 16 0 0 0 16-16v-80h8a8 8 0 0 0 0-16M69.2 48h117.6l24.89 56H44.31ZM64 200H40v-16h24Zm128 0v-16h24v16Zm24-32H40v-48h176ZM56 144a8 8 0 0 1 8-8h16a8 8 0 0 1 0 16H64a8 8 0 0 1-8-8m112 0a8 8 0 0 1 8-8h16a8 8 0 0 1 0 16h-16a8 8 0 0 1-8-8"/></symbol>
 <symbol id="bookmark" viewBox="0 0 256 256"><path fill="currentColor" d="M192 24H96a16 16 0 0 0-16 16v16H64a16 16 0 0 0-16 16v152a8 8 0 0 0 12.65 6.51L112 193.83l51.36 36.68A8 8 0 0 0 176 224v-39.31l19.35 13.82A8 8 0 0 0 208 192V40a16 16 0 0 0-16-16m-32 184.46l-43.36-31a8 8 0 0 0-9.3 0L64 208.45V72h96Zm32-32L176 165V72a16 16 0 0 0-16-16H96V40h96Z"/></symbol>
 <symbol id="money" viewBox="0 0 256 256"><path fill="currentColor" d="M128 88a40 40 0 1 0 40 40a40 40 0 0 0-40-40m0 64a24 24 0 1 1 24-24a24 24 0 0 1-24 24m112-96H16a8 8 0 0 0-8 8v128a8 8 0 0 0 8 8h224a8 8 0 0 0 8-8V64a8 8 0 0 0-8-8m-46.35 128H62.35A56.78 56.78 0 0 0 24 145.65v-35.3A56.78 56.78 0 0 0 62.35 72h131.3A56.78 56.78 0 0 0 232 110.35v35.3A56.78 56.78 0 0 0 193.65 184M232 93.37A40.8 40.8 0 0 1 210.63 72H232ZM45.37 72A40.8 40.8 0 0 1 24 93.37V72ZM24 162.63A40.8 40.8 0 0 1 45.37 184H24ZM210.63 184A40.8 40.8 0 0 1 232 162.63V184Z"/></symbol>
 <symbol id="comment" viewBox="0 0 256 256"><path fill="currentColor" d="M128 24a104 104 0 0 0-91.82 152.88l-11.35 34.05a16 16 0 0 0 20.24 20.24l34.05-11.35A104 104 0 1 0 128 24m0 192a87.87 87.87 0 0 1-44.06-11.81a8 8 0 0 0-6.54-.67L40 216l12.47-37.4a8 8 0 0 0-.66-6.54A88 88 0 1 1 128 216"/></symbol>
</svg> 

<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">
  <nav class="navbar navbar-expand-lg navbar-light container-fluid py-3 position-fixed">
    <div class="container">
      <a class="navbar-brand" href="design.index"><img src="images/logo.png" alt="logo" /></a>
      <button class="navbar-toggler me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav align-items-center justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active px-3" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="#rental">Booking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="#pricing">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="#services">Cars</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="#blog">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="#action">Contact</a>
            </li>
            <li class="nav-item dropdown text-center">
              <a class="nav-link px-3 dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                aria-expanded="false" href="#">Pages
                <iconify-icon icon="material-symbols:arrow-drop-down"></iconify-icon></a>
              <ul class="dropdown-menu">
                <li>
                  <a href="about.html" class="dropdown-item text-uppercase">About <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="blog.html" class="dropdown-item text-uppercase">Blog <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="single-post.html" class="dropdown-item text-uppercase">single-post
                    <span class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="cars.html" class="dropdown-item text-uppercase">Cars <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="car-single.html" class="dropdown-item text-uppercase">Car-Single <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="booking.html" class="dropdown-item text-uppercase">Booking <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="services.html" class="dropdown-item text-uppercase">Services <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="pricing.html" class="dropdown-item text-uppercase">Pricing <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="contact.html" class="dropdown-item text-uppercase">Contact <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="team.html" class="dropdown-item text-uppercase">Team <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="review.html" class="dropdown-item text-uppercase">Reviews <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
                <li>
                  <a href="faq.html" class="dropdown-item text-uppercase">FAQs <span
                      class="badge bg-secondary">Pro</span></a>
                </li>
              </ul>
            </li>
            <a class="fw-bold text-capitalize fs-5 px-3 py-2" target="_blank"
              href="https://templatesjungle.gumroad.com/l/limo-limousine-and-car-rental-free-html-website-template">Get Pro</a>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- hero section start  -->
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

    <!-- search section start  -->
    <section id="search position-absolute top-50 start-50 translate-middle">
      <div class="container search-block p-5">
        <form class="row">
          <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
            <label for="vehicle" class="label-style text-capitalize form-label text-white">Vehicle type</label>
            <div class="input-group date">
              <select class="form-select form-control p-3" id="vehicle" aria-label="Default select example"
                style="background-image: none">
                <option selected>Select Vehicle Type</option>
                <option value="1">BMW x3</option>
                <option value="2">BMW M2</option>
                <option value="3">Ford explorer</option>
                <option value="4">Ferrari</option>
                <option value="5">Mercedes-Benz</option>
                <option value="6">Sports car</option>
                <option value="7">Tesla</option>
              </select>
              <span class="search-icon-position position-absolute p-3">
                <iconify-icon class="search-icons" icon="solar:bus-outline"></iconify-icon>
              </span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
            <label for="location" class="label-style text-capitalize form-label text-white">Picking up location</label>
            
            <div class="input-group location text-dark">
              <input type="text" class="form-control p-3 position-relative" placeholder="Airport or anywhere" id="location">
              <span class="search-icon-position position-absolute p-3">
                <iconify-icon class="search-icons" icon="solar:map-arrow-square-outline"></iconify-icon>
              </span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
            <label for="pick-up-date" class="label-style text-capitalize form-label text-white">Picking up date</label>
            <div class="input-group date" id="datepicker1">
              <input type="text" class="form-control p-3" id="pick-up-date" />

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
              <input type="text" class="form-control p-3" id="return-date" />

              <span class="input-group-append">
                <span class="search-icon-position position-absolute p-3">
                  <iconify-icon class="search-icons" icon="solar:calendar-broken"></iconify-icon>
                </span>
              </span>
            </div>
          </div>
        </form>

        <div class="d-grid gap-2 mt-4">
          <button class="btn btn-primary" type="button">Find your car</button>
        </div>
      </div>
    </section>
  </section>
  <!-- process section start  -->
  <section id="process"  class="padding-small">
    <div class="process-content container">
      <div class="row justify-content-center text-center text-md-start g-4">
        <div class="col-lg-3 col-md-6">
          <h4 class="fst-italic" style="color:#D0D0D0;">01</h4>

          <p class="fw-bold text-dark mb-0">Choose a vehicle</p>
          <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
        </div>
        <div class="col-lg-3 col-md-6">
          <h4 class="fst-italic" style="color:#D0D0D0;">02</h4>
          <p class="fw-bold text-dark mb-0">Pick location & date</p>
          <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
        </div>
        <div class="col-lg-3 col-md-6">
          <h4 class="fst-italic" style="color:#D0D0D0;">03</h4>
          <p class="fw-bold text-dark mb-0">Book your car</p>
          <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
        </div>
        <div class="col-lg-3 col-md-6">
          <h4 class="fst-italic" style="color:#D0D0D0;">04</h4>
          <p class="fw-bold text-dark mb-0">Finish process</p>
          <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Great cars section start  -->
  <section id="card ">
    <div class="container ">
      <h2 class="text-uppercase text-center text-dark">
        great cars rental & Limousine Services
      </h2>
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="post pt-5 pb-3">
            <div class="image-zoom">
              <a href="blog-single.html" class="blog-img"><img src="images/rental-1.jpg" alt="" class="img-fluid" /></a>
            </div>
            <div class="text-center text-dark text-uppercase">
              <a href="#">
                <h4>hyundai</h4>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="blog-post pt-5 pb-3">
            <div class="image-zoom">
              <a href="blog-single.html" class="blog-img"><img src="images/rental-2.jpg" alt="" class="img-fluid" /></a>
            </div>
            <div class="text-center text-dark text-uppercase">
              <a href="#">
                <h4>jeep</h4>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="blog-post pt-5 pb-3">
            <div class="image-zoom">
              <a href="blog-single.html" class="blog-img"><img src="images/rental-3.jpg" alt="" class="img-fluid" /></a>
            </div>
            <div class="text-center text-dark text-uppercase">
              <a href="#">
                <h4>bmw</h4>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="blog-post pt-5 pb-3">
            <div class="image-zoom">
              <a href="blog-single.html" class="blog-img"><img src="images/rental-4.jpg" class="img-fluid" /></a>
            </div>
            <div class="text-center text-dark text-uppercase">
              <a href="#">
                <h4>benz</h4>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="blog-post pt-5 pb-3">
            <div class="image-zoom">
              <a href="blog-single.html" class="blog-img"><img src="images/rental-5.jpg" alt="" class="img-fluid" /></a>
            </div>
            <div class="text-center text-dark text-uppercase">
              <a href="#">
                <h4>ford</h4>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="blog-post pt-5 pb-3">
            <div class="image-zoom">
              <a href="blog-single.html" class="blog-img"><img src="images/rental-6.jpg" alt="" class="img-fluid" /></a>
            </div>
            <div class="text-center text-dark text-uppercase">
              <a href="#">
                <h4>range rover</h4>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- car gallery section start  -->

  <section id="gallery"  class="padding-small">
    <div class="container mb-5 pb-5">
      <h2 class="text-uppercase text-center text-dark">find by type</h2>
      <div class="mb-4 text-center">
        <p class="">
          <button
            class="filter-button text-secondary btn btn-light border border-secondary-subtle rounded-0 px-4 py-1 me-2 mb-3 text-capitalize"
            data-filter="*">
            All
          </button>
          <button
            class="filter-button text-secondary btn btn-light border border-secondary-subtle rounded-0 px-4 py-1 me-2 mb-3 text-capitalize"
            data-filter=".life">
            coupe
          </button>
          <button
            class="filter-button text-secondary btn btn-light border border-secondary-subtle rounded-0 px-4 py-1 me-2 mb-3 text-capitalize"
            data-filter=".travel">
            sedan
          </button>
          <button
            class="filter-button text-secondary btn btn-light border border-secondary-subtle rounded-0 px-4 py-1 me-2 mb-3 text-capitalize"
            data-filter=".love">
            suv
          </button>
        </p>
      </div>

      <div class="isotope-container">
        <div class="col-md-3 item life p-2">
          <a href="images/type1.jpg" title="Life" class="image-link"><img src="images/type1.jpg"
              class="post-image img-fluid" />
            <div class="types mt-2">
              <h4 class="text-center text-uppercase m-0 text-dark">Jeep</h4>
              <p class="text-center m-0 p-0">Starts from <b> 29$/day</b></p>

              <div class="d-flex justify-content-center">
                <a href="#" class="btn-underline mt-2 mb-2 text-uppercase fw-bold" style="font-size: 14px">Rent now</a>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 item health p-2">
          <a href="images/type8.jpg" title="Life" class="image-link"><img src="images/type8.jpg"
              class="post-image img-fluid" />
            <div class="types mt-2">
              <h4 class="text-center text-uppercase m-0 text-dark">
                Mercedes
              </h4>
              <p class="text-center m-0 p-0">Starts from <b> 29$/day</b></p>

              <div class="d-flex justify-content-center">
                <a href="#" class="btn-underline mt-2 mb-2 text-uppercase fw-bold" style="font-size: 14px">Rent now</a>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 item love p-2">
          <a href="images/type5.jpg" title="Life" class="image-link"><img src="images/type5.jpg"
              class="post-image img-fluid" />
            <div class="types mt-2">
              <h4 class="text-center text-uppercase m-0 text-dark">Bmx x3</h4>
              <p class="text-center m-0 p-0">Starts from <b> 29$/day</b></p>

              <div class="d-flex justify-content-center">
                <a href="#" class="btn-underline mt-2 mb-2 text-uppercase fw-bold" style="font-size: 14px">Rent now</a>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 item health p-2">
          <a href="images/type2.jpg" title="Life" class="image-link"><img src="images/type2.jpg"
              class="post-image img-fluid" />
            <div class="types mt-2">
              <h4 class="text-center text-uppercase m-0 text-dark">
                HYUNDAI
              </h4>
              <p class="text-center m-0 p-0">Starts from <b> 29$/day</b></p>

              <div class="d-flex justify-content-center">
                <a href="#" class="btn-underline mt-2 mb-2 text-uppercase fw-bold" style="font-size: 14px">Rent now</a>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-3 item life p-2">
          <a href="images/type4.jpg" title="Life" class="image-link"><img src="images/type4.jpg"
              class="post-image img-fluid" />
            <div class="types mt-2">
              <h4 class="text-center text-uppercase m-0 text-dark">
                Mercedes
              </h4>
              <p class="text-center m-0 p-0">Starts from <b> 29$/day</b></p>

              <div class="d-flex justify-content-center">
                <a href="#" class="btn-underline mt-2 mb-2 text-uppercase fw-bold" style="font-size: 14px">Rent now</a>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 item travel p-2">
          <a href="images/type3.jpg" title="Life" class="image-link"><img src="images/type3.jpg"
              class="post-image img-fluid" />
            <div class="types mt-2">
              <h4 class="text-center text-uppercase m-0 text-dark">ford</h4>
              <p class="text-center m-0 p-0">Starts from <b> 29$/day</b></p>

              <div class="d-flex justify-content-center">
                <a href="#" class="btn-underline mt-2 mb-2 text-uppercase fw-bold" style="font-size: 14px">Rent now</a>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 item travel p-2">
          <a href="images/type7.jpg" title="Life" class="image-link"><img src="images/type7.jpg"
              class="post-image img-fluid" />
            <div class="types mt-2">
              <h4 class="text-center text-uppercase m-0 text-dark">ford</h4>
              <p class="text-center m-0 p-0">Starts from <b> 29$/day</b></p>

              <div class="d-flex justify-content-center">
                <a href="#" class="btn-underline mt-2 mb-2 text-uppercase fw-bold" style="font-size: 14px">Rent now</a>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-3 item love p-2">
          <a href="images/type6.jpg" title="Life" class="image-link"><img src="images/type6.jpg"
              class="post-image img-fluid" />
            <div class="types mt-2">
              <h4 class="text-center text-uppercase m-0 text-dark">bmwx3</h4>
              <p class="text-center m-0 p-0">Starts from <b> 29$/day</b></p>

              <div class="d-flex justify-content-center">
                <a href="#" class="btn-underline mt-2 mb-2 text-uppercase fw-bold" style="font-size: 14px">Rent now</a>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- contact info section start  -->
  <section id="contact">
    <div class="position-relative jarallax" style="
          background: url('images/contact.jpg');
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center;
          height: 70vh;
        ">
      <div class="container">
        <div class="hero-content text-center position-absolute start-50 top-50 translate-middle">
          <h6 class="display-5 fw-bold text-uppercase text-white mb-2">
            contact info
          </h6>
          <p class="text-white">
            Nisi maecenas fermentum neque isi maecenas fermentum nequeaecenas
            fermentum neque isi maecenas fermentum neque aecenas fermentum
            neque isi maecenas fermentum neque.
          </p>
          <h4 class="fw-medium"><a href="#" class="text-white text-decoration-underline">Call us (99) 124 1242 12</a>
            <div> <button class="btn btn-primary rounded-0 mt-5" type="button">Contact us</button></div>
        </div>
      </div>
    </div>
  </section>

  <!-- pricing section start  -->
  <section id="pricing"  class="padding-small pb-0">
    <div class="container py-5 my-5">
      <h2 class="text-dark text-center my-5">
        Save by choosing the best plan
      </h2>

      <div class="d-flex justify-content-center">
        <label class="pt-2" id="monthly-label">Monthly</label>
        <span class="form-check form-switch p-0">
          <input class="form-check-input mx-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked />
          <label class="pt-2" id="yearly-label" for="flexSwitchCheckChecked">Yearly</label>
        </span>
      </div>

      <div class="row py-4">
        <div class="col-lg-4  col-12 my-2  pb-4">
          <div class="pricing-detail bg-light py-5 text-center">
            <div class="pricing-content">
              <h5>Essential</h5>

              <div class="content monthly pt-2">
                <h3>$29.50</h3>
              </div>
              <div class="content yearly pt-2">
                <h3>$350.70</h3>
              </div>

              <div class="pt-4">
                <p>✓ Quisque rhoncus</p>
                <p>✓ Lorem ipsum dolor</p>
                <p>✓ Vivamus velit mir</p>
                <p>✓ Velit mir</p>
                <p>✓ Elit mir ivamus</p>
              </div>
            </div>

            <div class="pricing-button">
              <button class="btn btn-dark rounded-0">Choose Plan</button>
            </div>
          </div>
        </div>

        <div class="col-lg-4  col-12 pb-4">
          <div class="pricing-detail bg-light py-5 text-center">
            <div class="pricing-content">
              <h5 class="price-recommend">Recommended</h5>
              <div class="content monthly pt-2">
                <h3>$44.40</h3>
              </div>
              <div class="content yearly pt-2">
                <h3>$530.60</h3>
              </div>

              <div class="pt-4">
                <p>✓ Quisque rhoncus</p>
                <p>✓ Lorem ipsum dolor</p>
                <p>✓ Vivamus velit mir</p>
                <p>✓ Elit mir ivamus</p>
                <p>✓ Lorem ipsum dolor</p>
                <p>✓ Ipsum dolor</p>
              </div>
            </div>

            <div class="pricing-button">
              <button class="btn btn-primary active rounded-0">Choose Plan</button>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-12 my-2 pb-4">
          <div class="pricing-detail bg-light py-5 text-center">
            <div class="pricing-content">
              <h5>Pro</h5>
              <div class="content monthly pt-2">
                <h3>$70.50</h3>
              </div>
              <div class="content yearly pt-2">
                <h3>$840.30</h3>
              </div>

              <div class="pt-4">
                <p>✓ Quisque rhoncus</p>
                <p>✓ Lorem ipsum dolor</p>
                <p>✓ Vivamus velit mir</p>
                <p>✓ Elit mir ivamus</p>
                <p>✓ Ivamus mir vamus</p>
                <p>✓ Quisque rhoncusr</p>
                <p>✓ lit mir iamus</p>
              </div>
            </div>

            <div class="pricing-button">
              <button class="btn btn-dark rounded-0">Choose Plan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="blog" class="padding-small pt-0">
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

   <!-- services section start  -->
   <section id="services" class="bg-light">
      <div class="container padding-small text-center">
        <div class="row justify-content-center text-center text-md-start g-4">
          <div class="col-lg-3 col-md-6">
            <div class="services">
              <svg class="services-icon" width="50"
                                      height="50">
                                      <use xlink:href="#car"></use>
                                  </svg>
            </div>

            <p class="fw-bold text-dark mb-0">Choose a vehicle</p>
            <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="services">
              <svg class="services-icon" width="50"
                                      height="50">
                                      <use xlink:href="#bookmark"></use>
                                  </svg>
            </div>
            <p class="fw-bold text-dark mb-0">Pick location & date</p>
            <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="services">
              <svg class="services-icon" width="50"
                                      height="50">
                                      <use xlink:href="#money"></use>
                                  </svg>
            </div>
            <p class="fw-bold text-dark mb-0">Book your car</p>
            <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="services">
              <svg class="services-icon" width="50"
                                      height="50">
                                      <use xlink:href="#comment"></use>
                                  </svg>
            </div>
            <p class="fw-bold text-dark mb-0">Finish process</p>
            <p class="text-secondary mb-0">Sed euismod mauris corper libero.</p>
          </div>
        </div>
    </div>
  </section>
  <!-- Footer Section Starts -->

  <section id="footer" class=" bg-dark text-white">
    <div class="container footer-container ">
      <footer class="row g-5 py-5 ">
        <div class="col-md-4">
          <img src="images/logo2.png" alt="image" />
          <p class="py-3">
            Vel non nibh vestibulum massa ullam corper bib endum ultrices
            venenatis, id id sed mass.
          </p>
          <div class="d-flex align-items-center">
            <a href="#" target="_blank"><iconify-icon class="social-link-icon pe-4  text-white"
                icon="mdi:facebook"></iconify-icon></a>
            <a href="#" target="_blank"><iconify-icon class="social-link-icon pe-4  text-white"
                icon="mdi:twitter"></iconify-icon></a>
            <a href="#" target="_blank"><iconify-icon class="social-link-icon pe-4  text-white"
                icon="mdi:instagram"></iconify-icon></a>
            <a href="#" target="_blank"><iconify-icon class="social-link-icon pe-4  text-white"
                icon="mdi:linkedin"></iconify-icon></a>
            <a href="#" target="_blank"><iconify-icon class="social-link-icon pe-4  text-white"
                icon="mdi:youtube"></iconify-icon></a>
          </div>
        </div>

        <div class="col-md-4">
          <h4 class="text-uppercase">CONTACT INFO</h4>
          <ul class="footer-nav list-unstyled d-block pt-3 ">
              <li class="pb-3"><a href="#"class="text-white"><svg class="contact me-1 " width="16" height="16">
                <use xlink:href="#location"></use>
              </svg>State Road 54 Trinity, Florida</a></li>
              <li class="pb-3"><a href="#"class="text-white"><svg class="contact me-1 " width="16" height="16">
                <use xlink:href="#call"></use>
              </svg>Call: 666 333 9999</a></li>
              <li class="pb-3"><a href="#"class="text-white"><svg class="contact me-1 " width="16" height="16">
                <use xlink:href="#time"></use>
              </svg>8:00-18:00, Sat: Closed</a></li>
          </ul>
        </div>

        
        <div class="col-md-4">
          <h4 class="text-uppercase">Subscribe our Newsletter</h4>
          <p class="py-3">
              Vel non nibh vestibulum massa ullam corper bib endum ultrices venenatis, id id sed mass.
          </p>
          <div class="d-flex align-items-center">
              <form class="w-100">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="input-group border-bottom">
                              <input type="email" class="form-control fst-italic bg-dark text-white border-0" placeholder="Enter your email">
                              <span class="input-group-btn">
                                <button class="btn text-white" type="submit">Subscribe</button>
                            </span>
                          </div>
                        </div>
                  </div>
              </form>
          </div>
      </div>
      
      </footer>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center border-top"></footer>

    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-2 pt-4">
        <div class="col-md-6 d-flex align-items-center">
          <p>©Limo, All rights reserved- Template design By:<a href="https://templatesjungle.com/" class="website-link text-white" target="_blank">
            <b><u>TemplatesJungle</u></b></a></p>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-end">
          <ul class="footer-nav list-unstyled">
            <li class="nav-item me-2">
                <a class="nav-link pe-3 text-white " href="#">Home</a>
            </li>
            <li class="nav-item me-2 mb-3">
                <a class="nav-link pe-3 text-white " href="#">Booking</a>
            </li>
            <li class="nav-item me-2 mb-3">
                <a class="nav-link pe-3 text-white " href="#">About</a>
            </li>
            <li class="nav-item me-2 mb-3">
                <a class="nav-link pe-3 text-white " href="#">Cars</a>
            </li>
            <li class="nav-item me-2 mb-3">
                <a class="nav-link pe-3 text-white " href="#">Blog</a>
            </li>
            <li class="nav-item me-2 mb-3">
                <a class="nav-link pe-3 text-white " href="#">Contact</a>
            </li>
        </ul>
        </div>
      </footer>
    </div>
  </section>

  <!-- script ================================================== -->
  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>
</body>

</html>