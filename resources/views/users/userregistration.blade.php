@extends('users.userlayout') 

@section('title', 'User Registration') 

@section('content')
<br><br>
<section class="register-page py-5">
    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card p-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Register</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf 

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Register</button>
                            </div>

                            <p class="text-center mt-3">
                                Already have an account? <a href="{{ route('login') }}">Login here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
@endsection

@section('head_scripts')
    <style>
        .card {
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 2rem;
        }
    
        .register-page {
            min-height: 120vh; 
            background-image: url('{{ asset('images/loginbackground.jpg') }}'); 
            background-size: cover; 
            background-position: center center; 
            background-repeat: no-repeat; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
    </style>
@endsection