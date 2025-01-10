@extends('auth.shell')

@section('content')
    <div class="row">
        <div class="col-10 col-md-7 col-lg-5 col-xl-4 mx-auto">
            <div class="card mx-auto">
                <div class="card-body">
                    <div class="mb-4">
                        <a href="/">
                            <img src="{{ asset('logo/aparri-rooms.jpg') }}" alt="Aparri Rooms Logo"
                                class="img-fluid mx-auto d-block" draggable="false">
                        </a>
                    </div>
                    <h5 class="card-title text-center">{{ __('Register') }}</h5>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" class="form-control" type="text" name="name"
                                value="{{ old('name') }}" required autofocus autocomplete="name" />
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" class="form-control" type="email" name="email"
                                value="{{ old('email') }}" required autocomplete="username" />
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" class="form-control" type="password" name="password" required
                                autocomplete="new-password" />
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" class="form-control" type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                            @error('password_confirmation')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label for="role" class="form-label">{{ __('Role') }}</label>
                            <select id="role" class="form-select" name="role" required>
                                <option value="tenant" {{ old('role') == 'tenant' ? 'selected' : '' }}>Tenant</option>
                                <option value="landlord" {{ old('role') == 'landlord' ? 'selected' : '' }}>Landlord
                                </option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('login') }}" class="text-sm text-muted">{{ __('Already registered?') }}</a>
                            <button type="submit" class="btn btn-primary ms-3">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
