<div class="modal" id="review-order" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="review-order-form" method="post" class="validate-form"
                  action="{{ route('orders.review', ['id'=> $order->id]) }}">
                @csrf()
                <div class="modal-header">
                    <h4 class="modal-title">Send Revision</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body padding-top-0">
                    <div class="form-group margin-top-0">
                        <label for="deadline">@lang('order.deadline')</label>
                        <select name="deadline" id="deadline" class="form-control" data-rule-required="true">
                            <option value="">-- Select Option --</option>
                            @foreach($reviewDeadlines as $reviewDeadline)
                                <option value="{{ $reviewDeadline->id }}">{{ $reviewDeadline->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">@lang('order.subject')</label>
                        <select name="subject" id="subject" class="form-control">
                            <option value="">-- Select Option--</option>
                            <option value="Plagiarism Detected">@lang('order.plagiarism_detected')</option>
                            <option value="Sources">@lang('order.sources')</option>
                            <option value="Instructions not followed">@lang('order.instructions_not_followed')</option>
                            <option value="Customize Content">@lang('order.customize_content')</option>
                            <option value="Others">@lang('order.other')</option>
                        </select>
                    </div>
                    <div class="form-group">
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
