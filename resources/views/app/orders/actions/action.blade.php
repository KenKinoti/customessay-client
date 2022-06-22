<div class="row">
    @if(!$order->paid)
        <div class="col-sm-6">
            <a href="{{ route('orders.edit',['id' => $order->id]) }}" class="btn btn-success btn-round">
                Make Payment
            </a>
        </div>
    @elseif($order->status == $status::FORWARDED)
        <div class="col-sm-6">
            <button class="btn btn-success btn-outline btn-sm" data-toggle="modal" data-target="#accept_order">
                Accept Order
            </button>
            @include('app.orders.modals.accept_order')
        </div>
        <div class="col-sm-6">
            <button class="btn btn-success btn-outline btn-sm" data-toggle="modal" data-target="#review-order">
                Send Revision
            </button>
            @include('app.orders.modals.review_order')
        </div>
        <div class="col-sm-6">
            <button class="btn btn-success btn-outline btn-sm" data-toggle="modal" data-target="#dispute-order">
                Dispute Order
            </button>
            @include('app.orders.modals.dispute')
        </div>
    @elseif($order->status == $status::DISPUTED)
        <button class="btn btn-success btn-outline btn-sm"
                onclick="document.getElementById('accept-order').submit()">
            Accept Order
        </button>
        <form id="accept-order" style="display: none" action="{{ route('orders.accept',['id' => $order->id]) }}"
              method="post">
            @csrf()
        </form>
        <div class="col-sm-6">
            <button class="btn btn-success btn-outline btn-sm" data-toggle="modal" data-target="#review-order">
                Send Revision
            </button>
            @include('app.orders.modals.review_order')
        </div>
    @elseif(($order->status == $status::FORWARDED || $order->status == $status::ACCEPTED ||
               $order->status == $status::AUTO_ACCEPTED|| $order->status == $status::MANUALLY_ACCEPTED)
               && $order->deadline_date->diffInDays(today()) <= 60)
        <div class="col-sm-6">
            <button class="btn btn-success btn-outline btn-sm" data-toggle="modal" data-target="#review-order">
                Send Revision
            </button>
            @include('app.orders.modals.review_order')
        </div>
        <div class="col-sm-6">
            <button class="btn btn-success btn-outline btn-sm" data-toggle="modal" data-target="#dispute-order">
                Dispute Order
            </button>
            @include('app.orders.modals.dispute')
        </div>
    @else
        <div class="col-sm-12">
            <small class="text-muted">No action required for now.</small>
        </div>
    @endif
</div>