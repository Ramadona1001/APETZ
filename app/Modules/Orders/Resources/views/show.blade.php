@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    @include('Orders::components.invoice',['invoice'=>$invoice])
</div>
@endsection

@section('javascript')

@endsection
