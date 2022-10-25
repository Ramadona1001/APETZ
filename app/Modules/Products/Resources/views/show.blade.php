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
            @include('Products::components.product',['product'=>$product])
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
