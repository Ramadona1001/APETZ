@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

    @include('backend.components.errors')

    <div class="col-lg-12">
        <div class="card card-preview">
            <div class="card-header">
                <h4>{{ $title }}</h4>
            </div>
            <div class="card-inner">
                <form action="{{ route('save_mainsettings') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach ($settings as $setting)
                        @php
                            $lang = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
                        @endphp
                        <div class="row mb-3">
                        @foreach ($lang as $lan)
                            @php
                                $value = ($setting->main_value != null) ? (array)json_decode($setting->main_value) : null;
                                $value = ($value != null) ? $value[$lan] : null;
                                $key = $setting->main_key.'['.$lan.']';
                            @endphp
                            <div class="col-lg-6">
                                <label for="{{ $lan.'_'.$setting->main_key }}">{{ transWord($setting->main_key).' '.transWord('In Language').' '.transWord($lan) }}</label>
                                @if (!in_array($setting->main_key,['logo','icon']))
                                    <input type="text" name="{{ $key }}" id="{{ $lan.'_'.$setting->main_key }}" class="form-control" placeholder="{{ transWord($setting->main_key).' '.transWord('In Language').' '.transWord($lan) }}" value="{{ $value }}">
                                @else
                                    <img src="{{ \URL::asset('/').setPublic().'uploads/backend/settings/'.$value }}" @if($setting->main_key == 'icon') style="filter: invert(1);" @endif class="setting_logo">
                                    <input type="file" name="{{ $key }}" id="{{ $lan.'_'.$setting->main_key }}" class="form-control" placeholder="{{ transWord($setting->main_key).' '.transWord('In Language').' '.transWord($lan) }}">
                                @endif
                            </div>
                        @endforeach
                        </div>
                    @endforeach
                    <input type="submit" value="{{ transWord('Save') }}" class="btn btn-primary">
                    </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

@endsection
