{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('auth.layouts.master')
@section('content')

<div class="form login">


    <span class="title">Login</span>
    <div style="text-align: center; margin-bottom: 20px;">
        {{-- <img style="max-width: 150px; height: auto;" alt="Company Logo"
            src="{{ $settings && $settings->logo ? asset('storage/' . $settings->logo) : asset('images/logo/chrisans-final-logo.png') }}"> --}}
    </div>
    <form action="{{ route('login') }}" method="POST">
        @csrf

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="input-field">
            <input type="text" name="email" placeholder="Enter your email" value="{{ old('email') }}" required />
            <i class="uil uil-envelope icon"></i>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="input-field">
            <input type="password" name="password" class="password" placeholder="Enter your password" required />
            <i class="uil uil-lock icon"></i>
            <i class="uil uil-eye-slash showHidePw"></i>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
        </div>

        <div class="checkbox-text">
            <div class="checkbox-content">
                <input type="checkbox" id="logCheck" name="remember" />
                <label for="logCheck" class="text">Remember me</label>
            </div>
        </div>
        <div style="margin-bottom: 30px; padding-top: 10px">
        <a href="{{ route('password.request') }}">Forgot password?</a>
    </div>
        <div class="input-field button">
            <input type="submit" value="Login" />
        </div>
    </form>


  </div>



@endsection


