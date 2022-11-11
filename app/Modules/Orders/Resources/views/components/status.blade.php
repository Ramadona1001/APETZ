@php
    $order_status = [
        0=>transWord('Ordered'),
        1=>transWord('In Progress'),
        2=>transWord('Shipping'),
        3=>transWord('Delivered'),
    ];
@endphp

{{-- Ordered --}}
@foreach ($order_status as $index => $status)
    @if ($order->status != $status)
        <a class="btn btn-secondary btn-sm" href="{{ route('change_orders_status',['order'=>$order->id,'status'=>$index]) }}"><span>{{ transWord('Change To').' '.$status }}</span></a>
    @endif
@endforeach

