@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

<style>
    .dropify-wrapper{
        height: 90%;
    }
</style>
@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="card-inner">
            <form action="{{ route('update_products',Crypt::encrypt($product->id)) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            {!! BuildFields('product_name' , getDataFromJson($product->product_name) , 'text' ,['required' => 'required']) !!}
                        </div>

                        <div class="row mt-3">
                            {!! BuildFields('product_descriptions' , getDataFromJson($product->product_descriptions) , 'textarea' ,['required' => 'required']) !!}
                        </div>


                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="qty">{{ transWord('Quantity') }}</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="qty" min="1" step="1" value="{{ $product->qty }}" id="qty" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="price">{{ transWord('Price') }}</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="price" min="0.5" step="0.5" value="{{ $product->price }}" id="price" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <label for="user_id">{{ transWord('Vendor') }}</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" @if($vendor->id == $product->user_id) selected @endif>{{ $vendor->first_name.' '.$vendor->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <label for="publish">{{ transWord('Publish') }}</label>
                                <select name="publish" id="publish" class="form-control">
                                    <option value="1" @if($product->publish == 1) selected @endif>{{ transWord('Publish') }}</option>
                                    <option value="0" @if($product->publish == 0) selected @endif>{{ transWord('Un Publish') }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-3">
                        <label for="product_image">{{ transWord('Product Image') }}</label>
                        <input type="file" name="product_image" height="100%" id="product_image" accept="images/*" class="dropify" data-default-file="{{ $product->product_image }}">
                    </div>
                </div>


                <button type="submit" class="btn btn-primary mt-3"><em class="icon ni ni-save-fill"></em>&nbsp;{{ transWord('Save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
@endsection
