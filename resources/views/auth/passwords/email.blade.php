@extends('backend.layouts.auth')

@section('title',transWord('Forget Password'))

@section('content')

<div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
            <img src="{{URL::asset('/')}}{{setPublic()}}uploads/backend/settings/{{ main_settings()['logo'] }}" alt="logo" width="150">
        </div>

        <div class="card card-bordered card-full">
          <div class="card-header"><h4>@yield('title')</h4></div>
          @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

          <div class="card-body">
            <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate="">
                @csrf
              <div class="form-group">
                <label for="email">{{ transWord('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                    @error('email')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
              </div>


              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  @yield('title')
                </button>
              </div>
            </form>

          </div>
        </div>

        <div class="simple-footer">
          {{ transWord('Copyright') }} &copy;
          {{ main_settings()['title'] }}
          {{ date('Y') }}
        </div>
      </div>
    </div>
  </div>

@endsection
