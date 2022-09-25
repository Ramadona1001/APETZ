@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

<style>
    .dropify-wrapper{
        height: 90%;
    }
</style>
@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="card-body">
            <form action="{{ route('store_users') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="first_name">{{ transWord('First Name') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="first_name" required class="form-control" placeholder="{{ transWord('First Name') }}" aria-label="{{ transWord('First Name') }}" name="first_name" aria-describedby="basic-addon1" value="{{ old('first_name') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="last_name">{{ transWord('Last Name') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="last_name" required class="form-control" placeholder="{{ transWord('Last Name') }}" aria-label="{{ transWord('Last Name') }}" name="last_name" aria-describedby="basic-addon1" value="{{ old('last_name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="email">{{ transWord('Email Address') }}</label>
                                <div class="input-group mb-3">
                                    <input type="email" name="email" required id="email" class="form-control email" placeholder="Ex: example@example.com" autocomplete="off" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="mobile">{{ transWord('Mobile') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="mobile" required id="mobile" class="form-control mobile" placeholder="{{ transWord('Mobile') }}" value="{{ old('mobile') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="password">{{ transWord('Password') }}</label>
                                <div class="input-group mb-3">
                                    <input type="password" required name="password" id="password" class="form-control email" placeholder="{{ transWord('Password') }}" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="confirmpass">{{ transWord('Confirm Password') }}</label>
                                <div class="input-group mb-3">
                                    <input type="password" required name="password_confirmation" id="confirmpass" class="form-control email" placeholder="{{ transWord('Confirm Password') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="gender">{{ transWord('Gender') }}</label>
                                <div class="input-group mb-3">
                                    <select name="gender" id="gender" class="form-control" required>
                                        @foreach (getGender() as $index => $gender)
                                            <option value="{{ $index }}">{{ $gender }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="birthdate">{{ transWord('Date of birth') }}</label>
                                <div class="input-group mb-3">
                                    <input type="date" required name="birthdate" id="birthdate" class="form-control email" placeholder="{{ transWord('Date of birth') }}" value="{{ old('birthdate') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <label for="address">{{ transWord('Address') }}</label>
                                <div class="input-group mb-3">
                                    <textarea name="address" rows="2" required id="address" cols="30" rows="10" class="form-control">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <h6>{{ transWord('Select Role') }}</h6>
                                <ul class="custom-control-group">
                                    @foreach ($roles as $role)
                                    <li>
                                        <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                            <input type="checkbox" class="custom-control-input" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}">
                                            <label class="custom-control-label" for="role_{{ $role->id }}">{{ transWord($role->name) }}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <label for="publish">{{ transWord('Publish') }}</label>
                                <select name="publish" id="publish" class="form-control">
                                    <option value="1">{{ transWord('Publish') }}</option>
                                    <option value="0">{{ transWord('Un Publish') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            {!! BuildFields('bio' , null , 'textarea' ) !!}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label for="avatar">{{ transWord('Profile Image') }}</label>
                        <input type="file" name="avatar" height="100%" id="avatar" accept="images/*" class="dropify">
                    </div>
                </div>


                <button type="submit" class="btn btn-primary mt-3"><em class="icon ni ni-save-fill"></em>&nbsp;{{ transWord('Save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
@endsection
