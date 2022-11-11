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
        <div class="card-inner">
            <table class="datatable-init-export nowrap table" data-export-title="Export">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ transWord('Product') }}</th>
                        <th>{{ transWord('Qty') }}</th>
                        <th>{{ transWord('Price') }}</th>
                        <th>{{ transWord('Total') }}</th>
                        <th>{{ transWord('Action') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">
                    @foreach ($order->items as $index => $item)
                        <tr>
                            <td>{{ ($index+1) }}</td>
                            <td>{{ getDataFromJsonByLanguage($item->product->product_name) }}</td>
                            <td>
                                <form action="{{ route('update_orders_qty',['item'=>$item->id]) }}" method="post" style="display: flex; justify-content: space-around;">
                                    @csrf
                                    <input type="number" name="new_qty" value="{{ $item->qty }}" min="1" step="1" class="form-control old_qty" style="width:50%">
                                    <button type="submit" class="btn btn-secondary btn-sm">{{ transWord('Update Quantity') }}</button>
                                </form>
                            </td>
                            <td>{{ $item->product->price }}</td>
                            <td>{{ $item->total }}</td>
                            <td>
                                <a href="{{ route('delete_orders_item',['order'=>$order->id,'item'=>$item->id]) }}" class="btn btn-danger btn-ms" onclick="return confirm('Are You Sure?')">X</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="card-inner">
            <form action="{{ route('update_orders',Crypt::encrypt($order->id)) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
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

@endsection
