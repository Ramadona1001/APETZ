@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            {{ $user->name.' '.transWord('Data') }}
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('First Name').' : '.$user->first_name }}</h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Last Name').' : '.$user->last_name }}</h5>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Email').' : '.$user->email }}</h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Mobile').' : '.$user->mobile }}</h5>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Gender').' : '.transWord($user->gender) }}</h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Date of birth').' : '.$user->birthdate }}</h5>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Address').' : '.$user->address }}</h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('BIO').' : '.getDataFromJsonByLanguage($user->bio) }}</h5>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <h5 class="mt-2 mb-2">{{ transWord('Roles') }}</h5>
                                @foreach (getUserRole($user->id) as $item)
                                <span class="badge badge-primary" style="font-weight: bold;font-size:13px;padding:10px;">{{ $item }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <img src="{{ $user->avatar }}"  style="width: 200px;height: 200px;display: block;margin-left: auto;margin-right: auto;border: 10px solid #22252a;padding: 10px;background: white;">
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
