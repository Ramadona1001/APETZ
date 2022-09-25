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
        <div class="card-body">
            <form action="{{ route('update_pages',Crypt::encrypt($pagedata->id)) }}" method="post" enctype="multipart/form-data">
                @csrf

                    <img src="{{ $pagedata->image }}" class="img-thumbnail img-display-block mb-3">


                    <div class="row">
                    {!! BuildFields('title' , getDataFromJson($pagedata->title) , 'text' ,['required' => 'required']) !!}
                    </div>


                    <div class="row">
                    {!! BuildFields('slug' , getDataFromJson($pagedata->slug) , 'text' ,['required' => 'required']) !!}
                    </div>


                    <div class="row">
                    {!! BuildFields('meta_title' , getDataFromJson($pagedata->meta_title) , 'text') !!}
                    </div>


                    <div class="row">
                    {!! BuildFields('meta_desc' , getDataFromJson($pagedata->meta_desc) , 'text') !!}
                    </div>


                    <div class="row">
                    {!! BuildFields('meta_keywords' , getDataFromJson($pagedata->meta_keywords) , 'text') !!}
                    </div>


                    <div class="row">
                    {!! BuildFields('content' , getDataFromJson($pagedata->content) , 'textarea' , ['required' => 'required']) !!}
                    </div>


                    <div class="row">
                    <div class="col-lg-12">
                        <label for="image">{{ transWord('Choose Image') }}</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    </div>





                <label for="publish" class="mt-3">{{ transWord('Publish') }}</label>
                <select name="publish" id="publish" class="form-control" required>
                    @if ($pagedata->publish == 1)
                    <option value="1">{{ transWord('Publish') }}</option>
                    <option value="2">{{ transWord('Unpublish') }}</option>
                    @else
                    <option value="2">{{ transWord('Unpublish') }}</option>
                    <option value="1">{{ transWord('Publish') }}</option>
                    @endif
                </select>

                <button type="submit" class="btn btn-primary mt-3"><em class="icon ni ni-save-fill"></em>&nbsp;{{ transWord('Save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
