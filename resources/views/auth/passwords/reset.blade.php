@extends('backend.layouts.auth')
@section('title',transWord('Reset Password'))
@section('content')
<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
        <a class="navbar-brand" href="javascript:void(0);"><img src="{{URL::asset('/')}}{{setPublic()}}uploads/backend/settings/{{ main_settings()['logo'] }}" width="30" height="30" class="d-inline-block align-top mr-2" alt="">{{ main_settings()['title'] }}</a>
        </div>
        <div class="card card-bordered card-full">
            <div class="body">
                <p class="lead">{{ transWord('Login') }}</p>
                <form class="form-auth-small m-t-20" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">{{ transWord('Email Address') }}</label>
                        <input type="email" lass="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">{{ transWord('Password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ transWord('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-round btn-block">{{ transWord('Reset Password') }}</button>

                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>

@endsection
