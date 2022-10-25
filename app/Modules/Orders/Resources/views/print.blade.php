@extends('backend.layouts.print')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('Orders::components.invoice',['invoice'=>$invoice])

@endsection

@section('javascript')

@endsection
