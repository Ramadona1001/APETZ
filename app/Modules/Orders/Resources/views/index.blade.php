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
                            @foreach (json_decode($order->products) as $item)
                                <span class="badge badge-secondary">
                                    {{ transWord('Product').' : '.$item->name.' - '.transWord('Price').' : '.$item->price.' - '.transWord('Quantity').' : '.$item->qty }}
                                </span>
                            @endforeach
                        </td>

                        <td>{{ $order->total_amount }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            {{ $order->other_notes }}
                        </td>
                        <td>
                            {{ $order->created_at }}
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                @can('show_products')
                                                <li><a href="{{ route('edit_products',Crypt::encrypt($order->id)) }}"><em class="icon ni ni-edit-fill"></em><span>{{ transWord('Edit') }}</span></a></li>
                                                @endcan
                                                @can('show_orders')
                                                <li><a href="{{ route('show_orders',Crypt::encrypt($order->id)) }}"><em class="icon ni ni-eye"></em><span>{{ transWord('Details') }}</span></a></li>
                                                @endcan
                                                @can('delete_products')
                                                <li><a href="{{ route('destroy_products',Crypt::encrypt($order->id)) }}" onclick="return confirm('Are You Sure?')"><em class="icon ni ni-trash"></em><span>{{ transWord('Delete') }}</span></a></li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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
