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
                                <label for="name">{{ transWord('Nick Name') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="name" required class="form-control" placeholder="{{ transWord('Nick Name') }}" aria-label="{{ transWord('Nick Name') }}" name="name" aria-describedby="basic-addon1" value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="type">{{ transWord('Type') }}</label>
                                <div class="input-group mb-3">
                                    <select name="type_id" id="type" class="form-control" required>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
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
                                            <option value="{{ $index }}">{{ $gender }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="age">{{ transWord('Age in month') }}</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="age" id="age" min="1" step="0.5" placeholder="{{ transWord('Age in month') }}" required class="form-control" value="{{ old('age') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="location">{{ transWord('Location') }}</label>
                                <div class="input-group">
                                    <input id="searchTextField" type="text" size="50" placeholder="{{ transWord('Enter a location') }}" autocomplete="on" runat="server" class="form-control" name="location"/>
                                </div>
                                <div class="input-group">
                                    <input type="hidden" value="{{ old('pet_lat') }}" name="pet_lat" required id="latitude" class="form-control " placeholder="{{ transWord('latitude') }}" readonly>
                                </div>
                                <div class="input-group">
                                    <input type="hidden" value="{{ old('pet_long') }}" name="pet_long" required id="longitude" class="form-control " placeholder="{{ transWord('longitude') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <label for="nationality">{{ transWord('Nationality') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nationality" id="nationality" placeholder="{{ transWord('Nationality') }}" required class="form-control" value="{{ old('nationality') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
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

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <label for="available_match">{{ transWord('Available Match') }}</label>
                                <div>
                                    <input type="radio" name="available_match" id="available" value="1" required>
                                    <label for="available">{{ transWord('Avaible') }}</label>
                                </div>
                                <div>
                                    <input type="radio" name="available_match" id="not_available" value="0" required>
                                    <label for="not_available">{{ transWord('Not Avaible') }}</label>
                                </div>
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
