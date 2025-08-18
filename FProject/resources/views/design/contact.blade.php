@extends('users.userlayout')
@section('content')
<section id="contact">
    <div class="position-relative jarallax" style="
        background: url('images/contact.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 90vh;
    ">
        <div class="container">
            <div class="hero-content text-center position-absolute start-50 top-50 translate-middle">
                <h6 class="display-5 fw-bold text-uppercase text-white mb-2">
                    contact info
                </h6>
                <p class="text-white">
                    For Any Query Feel Free to Contact Us  
                </p>
                <h4 class="fw-medium"><a href="#" class="text-white "> (+91) 124 1242 120</a></h4>
                <div>
                    <button class="btn btn-primary rounded-0 mt-5" type="button" onclick="showContactForm()">Contact us</button>
                </div>
                <div class="mt-3">
                    <a href="https://www.facebook.com/" target="_blank" class="mx-2 text-white">
                        <i class="fab fa-facebook-f fa-2x"></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" class="mx-2 text-white">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                    <a href="https://www.google.com/" target="_blank" class="mx-2 text-white">
                        <i class="fab fa-google fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact-form-section" style="display: none;">
    <div class="container py-5">
        <h2 class="text-center mb-4">Send Us a Message</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email' , $user->email ?? '') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div><br>
</section>

<script>
    function showContactForm() {
        var formSection = document.getElementById('contact-form-section');
        formSection.style.display = 'block';

        // Scroll to the form
        formSection.scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection