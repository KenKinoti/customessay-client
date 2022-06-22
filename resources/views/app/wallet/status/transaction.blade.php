@if($status == $transactionStatus::PENDING)
    <span class="badge badge-info">@lang('wallet.status.pending')</span>
@endif
@if($status == $transactionStatus::CANCELLED)
    <span class="badge badge-danger">@lang('wallet.status.cancelled')</span>
@endif
@if($status == $transactionStatus::FAILED)
    <span class="badge badge-danger">@lang('wallet.status.failed')</span>
@endif
@if($status == $transactionStatus::COMPLETE)
    <span class="badge badge-success">@lang('wallet.status.complete')</span>
@endif
