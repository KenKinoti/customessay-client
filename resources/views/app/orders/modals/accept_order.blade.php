<div class="modal" id="accept_order" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="review-order-form" method="post" class="validate-form"
                  action="{{ route('orders.accept', ['id'=> $order->id]) }}">
                @csrf()
                <div class="modal-header">
                    <h4 class="modal-title">@lang('order.accept_order')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body padding-top-0">
                    <hr class="margin-0 margin-top-15">
                    <div class="form-group margin-top-15">
                        <p class="margin-0"><strong>@lang('order.how_rate')</strong></p>
                        <div class="margin-top-5">
                            <select name="rating" id="rating">
                                <option value=""></option>
                                @for($i=1; $i<=5; $i++)
                                    <option value="{{$i}}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comments">Comment</label>
                        <textarea name="comments" data-rule="required" id="comments" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-simple"
                            data-dismiss="modal"> @lang('oder.close')
                    </button>
                    <button type="submit" class="btn btn-primary btn-round">
                        <i class="ti ti-check"></i> @lang('order.accept_order')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
