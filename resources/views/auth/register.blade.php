@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
            <i class="fas fa-building me-2"></i>MY PROPERTY
        </a>
    </div>
</nav>

<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h4 class="fw-bold text-center text-primary">{{ __('Create Your Account') }}</h4>
                    <p class="text-muted text-center mb-0">Join us to manage your properties</p>
                </div>

                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Full Name') }}</label>
                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                   placeholder="Enter your full name">
                            <div class="form-text">This will be displayed on your profile</div>

                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   placeholder="Enter your email">
                            <div class="form-text">We'll never share your email with others</div>

                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="Create a password">
                            <div class="form-text">Minimum 8 characters</div>

                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Confirm your password">
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg py-2 fw-bold">
                                {{ __('Create Account') }}
                            </button>
                        </div>

                        <div class="text-center text-muted mt-4">
                            <hr class="my-3">
                            <p class="mb-0">Already have an account?
                                <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary">
                                    {{ __('Sign In') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
