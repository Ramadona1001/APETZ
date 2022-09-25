@extends('backend.layouts.master')

@section('title',transWord('Home'))

@section('stylesheet')

@endsection

@section('content')

{!! statisticsWidget($components) !!}

{{-- {{ dd($number = cal_days_in_month(CAL_GREGORIAN, 2, 2022)) }} --}}


@endsection

@section('javascript')
@endsection
