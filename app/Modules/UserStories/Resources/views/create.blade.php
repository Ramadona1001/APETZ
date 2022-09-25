@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')
@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="card-body">
            <form action="{{ route('store_pets') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="story_text">{{ transWord('Story Text [optional]') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="story_text" class="form-control" placeholder="{{ transWord('Story Text [optional]') }}" aria-label="{{ transWord('Story Text [optional]') }}" name="story_text" aria-describedby="basic-addon1" value="{{ old('story_text') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label for="story_file">{{ transWord('Story Image [optional]') }}</label>
                                <div class="input-group mb-3">
                                    <input type="file" id="story_file" class="form-control" placeholder="{{ transWord('Nick Name') }}" aria-label="{{ transWord('Nick Name') }}" name="story_file" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="user">{{ transWord('User') }}</label>
                                <div class="input-group mb-3">
                                    <select name="user_id" id="user" class="form-control" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="publish">{{ transWord('Publish') }}</label>
                                <select name="publish" id="publish" class="form-control">
                                    <option value="1">{{ transWord('Publish') }}</option>
                                    <option value="0">{{ transWord('Un Publish') }}</option>
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
<script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false&language=AR&key=AIzaSyBy0gKwjMF1PQhEivQBlrS232ko0lGh4bE"
        type="text/javascript"></script>

    <script type="text/javascript">
        function initialize() {
            var input = document.getElementById('searchTextField');
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                var province = place.address_components.find(item => item.types.includes(
                    'administrative_area_level_1'));

                // document.getElementById('city').value = province.long_name;
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection
