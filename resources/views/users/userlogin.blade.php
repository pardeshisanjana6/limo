@extends('users.userlayout') 

@section('title', 'User Login') 

@section('content')
<br><br>
<section class="login-page py-5">
    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card p-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Login</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf 

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                            </div>

                            <p class="text-center mt-3">
                                Don't have an account? <a href="{{ route('register') }}">Register here</a>
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
        .form-check-input:checked {
            background-color: #93644eff; 
        }

        .login-page {
            min-height: 100vh; 
            background-image: url('{{ asset('images/loginbackground.jpg') }}'); 
            background-size: cover; 
            background-position: center center; 
            background-repeat: no-repeat; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .card {
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 2rem;
        }
    </style>
@endsection