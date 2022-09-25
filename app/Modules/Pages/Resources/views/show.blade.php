@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            <img src="{{ $pagedata->image }}" class="img-thumbnail img-display-block">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="card card-bordered card-full">
                      <div class="profile-widget-description pb-0">
                        <div class="card-header">
                            <h4>{{ getDataFromJsonByLanguage($pagedata->title) }}</h4>
                        </div>
                        <div class="card-body">
                            {!! getDataFromJsonByLanguage($pagedata->content) !!}
                        </div>
                        <hr>
                        <h4>
                            {{ transWord('Slug').': ' }}
                            <i class="fa fa-link"></i>
                            {{ getDataFromJsonByLanguage($pagedata->slug) }}
                        </h4>
                      </div>
                      <div class="card-footer text-center pt-0">
                        @if ($pagedata->publish == 1)
                        <span class="badge badge-primary">{{ transWord('Publish') }}</span>
                        @else
                        <span class="badge badge-danger">{{ transWord('Un Publish') }}</span>
                        @endif
                      </div>

                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="card card-bordered card-full">
                        <div class="card-header">
                            <h4>{{ transWord('Meta Data') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12"><h6 class="mb-3">{{ transWord('Title') }}: {{ getDataFromJsonByLanguage($pagedata->meta_title) }}</h6></div>
                            <div class="col-lg-12"><h6 class="mb-3">{{ transWord('Descriptions') }}: {{ getDataFromJsonByLanguage($pagedata->meta_desc) }}</h6></div>
                            <div class="col-lg-12"><h6 class="mb-3">{{ transWord('Keywords') }}: {{ getDataFromJsonByLanguage($pagedata->meta_keywords) }}</h6></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
