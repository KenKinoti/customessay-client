<div class="p-4">
    @include('orders.partials.details')
    @include('orders.partials.pricing_details')
</div>
@guest
    <hr>
    <div class="p-2">
        @include('orders.partials.account')
    </div>
@endguest
