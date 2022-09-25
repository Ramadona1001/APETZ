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
        <div class="card-inner">
            <form action="{{ route('update_pets',$pet->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="name">{{ transWord('Nick Name') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="name" required class="form-control" placeholder="{{ transWord('Nick Name') }}" aria-label="{{ transWord('Nick Name') }}" name="name" aria-describedby="basic-addon1" value="{{ $pet->name }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="type">{{ transWord('Type') }}</label>
                                <div class="input-group mb-3">
                                    <select name="type_id" id="type" class="form-control" required>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" @if($pet->type_id == $type->id) selected @endif>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="gender">{{ transWord('Gender') }}</label>
                                <div class="input-group mb-3">
                                    <select name="gender" id="gender" class="form-control" required>
                                        @foreach (getGender() as $index => $gender)
                                            <option value="{{ $index }}" @if($pet->gender == $index) selected @endif>{{ $gender }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="age">{{ transWord('Age in month') }}</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="age" id="age" min="1" step="0.5" placeholder="{{ transWord('Age in month') }}" required class="form-control" value="{{ $pet->age }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="location">{{ transWord('Location') }}</label>
                                <div class="input-group">
                                    <input id="searchTextField" type="text" value="{{ $pet->location }}" size="50" placeholder="{{ transWord('Enter a location') }}" autocomplete="on" runat="server" class="form-control" name="location"/>
                                </div>
                                <div class="input-group">
                                    <input type="hidden" value="{{ $pet->pet_lat }}" name="pet_lat" required id="latitude" class="form-control " placeholder="{{ transWord('latitude') }}" readonly>
                                </div>
                                <div class="input-group">
                                    <input type="hidden" value="{{ $pet->pet_long }}" name="pet_long" required id="longitude" class="form-control " placeholder="{{ transWord('longitude') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="nationality">{{ transWord('Nationality') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nationality" value="{{ $pet->nationality }}" id="nationality" placeholder="{{ transWord('Nationality') }}" required class="form-control" value="{{ old('nationality') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <label for="user">{{ transWord('User') }}</label>
                                <div class="input-group mb-3">
                                    <select name="user_id" id="user" class="form-control" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($pet->user_id == $user->id) selected @endif>{{ $user->first_name.' '.$user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <label for="available_match">{{ transWord('Available Match') }}</label>
                                <div>
                                    <input type="radio" name="available_match" id="available" value="1" @if($pet->available_match == 1) checked @endif required>
                                    <label for="available">{{ transWord('Avaible') }}</label>
                                </div>
                                <div>
                                    <input type="radio" name="available_match" id="not_available" value="0" @if($pet->available_match == 0) checked @endif required>
                                    <label for="not_available">{{ transWord('Not Avaible') }}</label>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <label for="publish">{{ transWord('Publish') }}</label>
                                <select name="publish" id="publish" class="form-control">
                                    <option value="1" @if($user->publish == 1) selected @endif>{{ transWord('Publish') }}</option>
                                    <option value="0" @if($user->publish == 0) selected @endif>{{ transWord('Un Publish') }}</option>
                                </select>
                            </div>
                        </div>
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
