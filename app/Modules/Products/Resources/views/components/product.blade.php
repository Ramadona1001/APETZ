<div class="row">
    <div class="col-lg-9">
        <div class="row mb-1">
            <div class="col-lg-12">
                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Product Name').' : '.getDataFromJsonByLanguage($product->product_name) }}</h5>
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-lg-12">
                <div class="badge badge-lg badge-secondary w-100">
                    <p>{{ getDataFromJsonByLanguage($product->product_name) }}</p>
                </div>
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-lg-6">
                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Price').' : '.$product->price }}</h5>
            </div>
            <div class="col-lg-6">
                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Quantity').' : '.$product->qty }}</h5>
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-lg-6">
                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Vendor').' : '.$product->user->first_name.' '.$product->user->last_name }}</h5>
            </div>
            <div class="col-lg-6">
                <h5 class="badge badge-lg badge-secondary w-100">{{ transWord('Publish Status') }} : {{ ($product->publish == 0) ? transWord('Un Publish') : transWord('Publish') }}</h5>
            </div>
        </div>
    </div>


    <div class="col-lg-3">
        <img src="{{ $product->product_image }}"  style="width: 200px;height: 200px;display: block;margin-left: auto;margin-right: auto;border: 10px solid #22252a;padding: 10px;background: white;">
    </div>
</div>
