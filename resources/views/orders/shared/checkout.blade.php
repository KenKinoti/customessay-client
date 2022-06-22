<div class="sticky card mx-md-2">
    <small class="card-title text-center text-black-50 text-uppercase py-3 font-weight-bold">
        @lang('order.form.summary_title') 
    </small>
    <div class="card-body pt-0">
        @include('orders.partials.summary')
    </div>
    <div class="px-2">
        @include('orders.partials.payment_methods')
    </div>
    <div class="card-footer border-0">
        <button type="submit" class="btn btn-primary btn-block btn-lg">
            <i class="ti ti-shopping-cart"></i> Safe Checkout
        </button>
    </div>
</div>
<input type="hidden" id="totalAmount">
@include('orders.partials.prices')
