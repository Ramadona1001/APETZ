@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-primary">
        <div class="card-body">
            <h4 class="mb-3">{{ transWord('Title').' : '.getDataFromJsonByLanguage($blog->title) }}</h4>
            <h5>{!! getDataFromJsonByLanguage($blog->content) !!}</h5>
            @if ($blog->publish == 1)
            <span class="badge badge-primary">{{ transWord('Publish') }}</span>
            @else
            <span class="badge badge-danger">{{ transWord('Un Publish') }}</span>
            @endif
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
