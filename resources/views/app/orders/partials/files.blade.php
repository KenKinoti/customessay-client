@if($order->status != $status::CANCELLED && $order->status != $status::REFUNDED )
    <button class="btn btn-primary btn-circled my-2" data-toggle="modal"
            data-target="#add-new-files">
        <i class="ti ti-upload"></i> @lang('order.upload_files')
    </button>
@endif
<div class="clearfix"></div>
<table class="table files">
    <tr>
        <th>File</th>
        <th width="20%">@lang('order.uploader')</th>
    </tr>
    @forelse($order->getMedia('orders') as $media)
        @if($media->getCustomProperty('target') == "Client" || $media->getCustomProperty('target') == "All")
            <tr>
                <td>
                    <a href="{{ route('orders.download',['mediaItem' => $media->id]) }}">
                        <p class="margin-0">#{{ $order->id }}_{{ Illuminate\Support\Str::limit($media->file_name,30) }}</p>
                        <small class="text-muted">
                            @if($media->hasCustomProperty('order_files'))
                                {{ $media->getCustomProperty('order_files')  }}
                            @endif
                        </small>
                    </a>
                </td>
                <td>
                    <p class="margin-0">
                        {{ $media->getCustomProperty('uploader') == "Client"?"Client":"Writer" }}
                    </p>
                    <small class="text-muted">
                        {{ $media->updated_at }}
                    </small>
                </td>
            </tr>
        @endif
    @empty
        <tr>
            <td colspan="2" align="center">@lang('order.no_files')</td>
        </tr>
    @endforelse
</table>

@include('app.orders.modals.add_new_files')
