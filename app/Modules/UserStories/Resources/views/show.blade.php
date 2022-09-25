@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            {{ $pet->name.' '.transWord('Data') }}
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Nick Name').' : '.$pet->name }}</h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Type').' : '.$pet->type->name }}</h5>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Gender').' : '.$pet->gender }}</h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Location').' : '.$pet->location }}</h5>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Age').' : '.$pet->age.' '.transWord('Months') }}</h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Nationality').' : '.$pet->nationality }}</h5>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Owner').' : '.$pet->user->first_name.' '.$pet->user->last_name }}</h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Available Match').' : ' }}
                                    @if ($pet->available_match == 1)
                                        {{ transWord('Available') }}
                                    @else
                                        {{ transWord('Not Available') }}
                                    @endif
                                </h5>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Publish').' : ' }}
                                    @if ($pet->publish == 1)
                                        {{ transWord('Publish') }}
                                    @else
                                        {{ transWord('Not Publish') }}
                                    @endif
                                </h5>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-center">{{ transWord('Gallery') }}</h4>
                    </div>
                </div>
                <div class="row mt-2">
                    @foreach ($gallery as $image)
                        <div class="col-lg-2 mb-2">
                            <div class="pet-gallery-card">
                                <img src="{{ $image->media_path }}" alt="{{ $pet->name }}" class="img-responsive img-thumbnail">
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBy0gKwjMF1PQhEivQBlrS232ko0lGh4bE&callback=initMap"></script>

<script>
 function initMap() {
//   alert(1);
}

// window.initMap = initMap;


</script>
@endsection
