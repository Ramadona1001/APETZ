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
        <div class="card-body">
            <form action="{{ route('store_orders') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <h6 class="alert alert-primary">
                            {{ transWord('If the quantity of product is 0 the product does not chosen') }}
                        </h6>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label for="user">{{ transWord('User') }}</label>
                        <select name="user" id="user" class="form-control" required>
                            <option value="">{{ transWord('Select User') }}</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label for="notes">{{ transWord('Notes') }}</label>
                        <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                    @foreach ($products as $index => $product)
                        <div class="col-lg-4">
                            <div class="card card-bordered card-full">
                                <div class="card-header text-center">
                                    {{ getDataFromJsonByLanguage($product->product_name) }}
                                    <span class="badge badge-secondary mr-2 ml-2">
                                        {{ transWord('Price') }} :
                                        {{ $product->price }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <img class="pro_img_card" src="{{ $product->product_image }}" alt="">
                                    <label for="pro_qty_{{ $product->id }}" class=" mt-2">{{ transWord('Quantity') }}</label>
                                    <input type="number" name="products[{{ $index }}][qty]" class="form-control" id="pro_qty_{{ $product->id }}" value="0" min="0" max="{{ $product->qty }}">
                                    <input type="hidden" name="products[{{ $index }}][id]" value="{{ $product->id }}">
                                    <input type="hidden" name="products[{{ $index }}][price]" value="{{ $product->price }}">
                                    <input type="hidden" name="products[{{ $index }}][name]" value="{{ getDataFromJsonByLanguage($product->product_name) }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
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
