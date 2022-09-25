@extends('backend.layouts.auth')
@section('title',transWord('Login'))

@section('content')

<div class="nk-wrap nk-wrap-nosidebar">
    <!-- content @s -->
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
            <div class="brand-logo pb-4 text-center">
                <a href="#" class="logo-link">
                    <img src="{{URL::asset('/')}}{{setPublic()}}uploads/backend/settings/{{ main_settings()['logo'] }}" class="logo-light logo-img logo-img-lg">
                </a>
            </div>
            <div class="card card-bordered">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Sign-In</h4>
                            <div class="nk-block-des">
                                <p>{{ transWord('Login Into Dashboard') }}</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">{{ transWord('Email') }}</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="email" name="email" class="form-control form-control-lg" id="default-01" placeholder="{{ transWord('Email') }}" required>
                            </div>
                            @error('email')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">{{ transWord('Password') }}</label>
                                <a class="link link-primary link-sm" href="html/pages/auths/auth-reset-v2.html">Forgot Code?</a>
                            </div>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="{{ transWord('Password') }}">
                            </div>
                            @error('password')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="nk-footer nk-auth-footer-full">
            <div class="container wide-lg">
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="nk-block-content text-center text-lg-left">
                            <p class="text-soft text-center">
                                {{ transWord('Copyright') }} &copy;
                                {{ main_settings()['title'] }}
                                {{ date('Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wrap @e -->
</div>

@endsection
