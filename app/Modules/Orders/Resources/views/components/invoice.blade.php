<div class="invoice">
    <div class="invoice-action">
        <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="{{ route('print_orders',Crypt::encrypt($invoice->id)) }}" target="_blank"><em class="icon ni ni-printer-fill"></em></a>
    </div><!-- .invoice-actions -->
    <div class="invoice-wrap">
        <div class="invoice-brand text-center">
            <img src="{{URL::asset('/')}}{{setPublic()}}uploads/backend/settings/{{ main_settings()['logo'] }}" srcset="{{URL::asset('/')}}{{setPublic()}}uploads/backend/settings/{{ main_settings()['logo'] }} 2x" alt="">
        </div>
        <div class="invoice-head">
            <div class="invoice-contact">
                <span class="overline-title">{{ transWord('Invoice To') }}</span>
                <div class="invoice-contact-info">
                    <h4 class="title">{{ $invoice->user->first_name.' '.$invoice->user->last_name }}</h4>
                    <ul class="list-plain">
                        <li><em class="icon ni ni-map-pin-fill"></em><span>{{ $invoice->user->address }}</span></li>
                        <li><em class="icon ni ni-call-fill"></em><span>{{ $invoice->user->mobile }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="invoice-desc">
                <h3 class="title">{{ transWord('Invoice') }}</h3>
                <ul class="list-plain">
                    <li class="invoice-id"><span>{{ transWord('Invoice ID') }}</span>:<span> #{{ $invoice->id }}</span></li>
                    <li class="invoice-date"><span>{{ transWord('Date') }}</span>:<span>{{ $invoice->created_at }}</span></li>
                </ul>
            </div>
        </div><!-- .invoice-head -->
        <div class="invoice-bills">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ transWord('Product') }}</th>
                            <th>{{ transWord('Qunatity') }}</th>
                            <th>{{ transWord('Price') }}</th>
                            <th>{{ transWord('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($invoice->products) as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">{{ transWord('Subtotal') }} : {{ $invoice->total_amount }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- .invoice-bills -->
    </div><!-- .invoice-wrap -->
</div>
