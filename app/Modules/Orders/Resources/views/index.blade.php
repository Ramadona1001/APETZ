@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

<div class="col-lg-12">
    <div class="card card-preview">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-inner">
            <table class="datatable-init-export nowrap table" data-export-title="Export">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ transWord('User') }}</th>
                        <th>{{ transWord('Items') }}</th>
                        <th>{{ transWord('Total Amount') }}</th>
                        <th>{{ transWord('Status') }}</th>
                        <th>{{ transWord('Notes') }}</th>
                        <th>{{ transWord('Order At') }}</th>
                        <th>{{ transWord('Actions') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">
                    @foreach ($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @can('show_users')
                            <a target="_blank" href="{{ route('show_users',Crypt::encrypt($order->user->id)) }}">
                                {{ $order->user->first_name.' '.$order->user->last_name }}
                            </a>
                            @else
                                {{ $order->user->first_name.' '.$order->user->last_name }}
                            @endcan
                        </td>
                        <td>
                            @foreach ($order->items as $item)
                                <span class="badge badge-secondary">
                                    {{ transWord('Product').' : '.getDataFromJsonByLanguage($item->product->product_name).' - '.transWord('Price').' : '.$item->product->price.' - '.transWord('Quantity').' : '.$item->qty }}
                                </span>
                            @endforeach
                        </td>

                        <td>{{ $order->total }}</td>
                        <td><span class="badge badge-secondary">{{ $order->status }}</span></td>
                        <td>
                            {{ $order->other_notes }}
                        </td>
                        <td>
                            {{ $order->created_at }}
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            @can('show_orders')
                                <a class="btn btn-secondary btn-sm" href="{{ route('edit_orders',Crypt::encrypt($order->id)) }}"><em class="icon ni ni-edit-fill"></em><span>{{ transWord('Edit') }}</span></a>
                            @endcan
                            @can('show_orders')
                                <a class="btn btn-secondary btn-sm" href="{{ route('show_orders',Crypt::encrypt($order->id)) }}"><em class="icon ni ni-eye"></em><span>{{ transWord('Details') }}</span></a>
                            @endcan
                            @can('delete_orders')
                                <a class="btn btn-danger btn-sm" href="{{ route('destroy_orders',Crypt::encrypt($order->id)) }}" onclick="return confirm('Are You Sure?')"><em class="icon ni ni-trash"></em><span>{{ transWord('Delete') }}</span></a>
                            @endcan
                            @can('status_orders')
                                @include('Orders::components.status',['order'=>$order])
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
