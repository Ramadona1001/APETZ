@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-inner">
            <form action="{{ route('store_pages') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                {!! BuildFields('title' , null , 'text' ,['required' => 'required']) !!}
                </div>


                <div class="row">
                {!! BuildFields('slug' , null , 'text' ,['required' => 'required']) !!}
                </div>


                <div class="row">
                {!! BuildFields('meta_title' , null , 'text') !!}
                </div>


                <div class="row">
                {!! BuildFields('meta_desc' , null , 'text') !!}
                </div>


                <div class="row">
                {!! BuildFields('meta_keywords' , null , 'text') !!}
                </div>


                <div class="row">
                {!! BuildFields('content' , null , 'textarea' , ['required' => 'required']) !!}
                </div>


                <div class="row">
                <div class="col-lg-12">
                    <label for="image">{{ transWord('Choose Image') }}</label>
                    <input type="file" name="image" required id="image" class="form-control">
                </div>
                </div>



                <label for="publish" class="mt-3">{{ transWord('Publish') }}</label>
                <select name="publish" id="publish" class="form-control" required>
                    <option value="">{{ transWord('Please Select') }}</option>
                    <option value="1">{{ transWord('Publish') }}</option>
                    <option value="2">{{ transWord('Unpublish') }}</option>
                </select>

                <button type="submit" class="btn btn-primary mt-3"><em class="icon ni ni-save-fill"></em>&nbsp;{{ transWord('Save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
@endsection
