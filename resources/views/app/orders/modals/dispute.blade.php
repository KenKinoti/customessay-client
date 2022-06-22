<div class="modal" id="dispute-order" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="dispute-order-form" method="post" class="validate-form"
                  action="{{ route('orders.dispute', ['id'=> $order->id]) }}">
                @csrf()
                <div class="modal-header">
                    <h4 class="modal-title">@lang('order.dispute_order')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body padding-top-0">
                    <div class="form-group margin-top-0">
                        <label for="comments" class="control-label">@lang('order.comments')</label>
                        <textarea data-rule-required="true" name="comments" id="comments" rows="4"
                                  class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-simple"
                            data-dismiss="modal"> @lang('order.close')
                    </button>
                    <button type="submit" class="btn btn-primary btn-round">
                        @lang('order.submit')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
