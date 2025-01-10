@extends('auth.shell')

@section('content')
    <div class="row">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <a href="/">
                            <img src="{{ asset('logo/aparri-rooms.jpg') }}" alt="Aparri Rooms Logo"
                                class="img-fluid mx-auto d-block" draggable="false">
                        </a>
                    </div>

                    <h5 class="card-title text-center">{{ __('Login') }}</h5>

                    <form method="POST" action="{{ route('login') }}" class=" ">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" class="form-control" type="email" name="email"
                                value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" class="form-control" type="password" name="password" required
                                autocomplete="current-password">
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label text-muted">{{ __('Remember me') }}</label>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="d-flex justify-content-between">
                            @if (Route::has('password.request'))
                                <a class="text-muted text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                            <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        Don't have an account?
                        <a class="text-muted " href="{{ route('register') }}">
                            Register Here
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
