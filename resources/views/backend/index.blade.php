@extends('backend.layouts.master')

@section('title',transWord('Home'))

@section('stylesheet')

@endsection

@section('content')

{!! statisticsWidget($components) !!}

@endsection

@section('javascript')
@endsection
