<table class="table table-bordered table-striped margin-top-10">
    <tbody>
    <tr>
        <td width="25%"><strong>@lang('order.topic')</strong></td>
        <td>{{ $order->topic }}</td>
    </tr>
    <tr>
        <td><strong>@lang('order.academic_level'):</strong></td>
        <td> {{ $order->academiclevel->name }}</td>
    </tr>
    <tr>
        <td><strong>@lang('order.discipline'):</strong></td>
        <td>{{ $order->discipline->name }}</td>
    </tr>
    <tr>
        <td><strong>@lang('order.paper_type'):</strong></td>
        <td>{{ $order->paperType->name }}</td>
    </tr>
    <tr>
        <td><strong>@lang('order.deadline'):</strong></td>
        <td>@include('app.partials.order.deadline')</td>
    </tr>
    <tr>
        <td><strong>@lang('order.number_pages')</strong>:</td>
        <td>{{ $order->pages }}</td>
    </tr>
    <tr>
        <td><strong>@lang('order.spacing')</strong>:</td>
        <td> {{ $order->spacing }}</td>
    </tr>
    <tr>
        <td><strong>@lang('order.number_words')</strong>:</td>
        <td> {{ $order->spacing == "double"? 300 * $order->pages:300 * $order->pages * 2 }}</td>
    </tr>
    <tr>
        <td><strong>@lang('order.number_sources')</strong>:</td>
        <td> {{ $order->sources?:"Not Specified" }}</td>
    </tr>
    @if(isset($order->citation->name))
        <tr>
            <td><strong>@lang('order.citation')</strong>:</td>
            <td> {{ $order->citation->name }}</td>
        </tr>
    @else
        <tr>
            <td><strong>@lang('order.citation')</strong>:</td>
            <td> {{ $order->citation_id }}</td>
        </tr>
    @endif
    @if($order->ppt_slides)
        <tr>
            <td><strong>@lang('order.ppt_slides')</strong>:</td>
            <td><span class="badge badge-default font-size-12">{{ $order->ppt_slides }}</span></td>
        </tr>
        <tr>
        <td><strong>Speaker Notes</strong>:</td>
        <td><span class="label label-default font-size-12">{{ $order->has_speaker_notes ? 'Yes': 'No' }}</span></td>
        </tr>
    @endif
    @if($order->charts)
        <tr>
            <td><strong>@lang('order.charts')</strong>:</td>
            <td><span class="badge badge-default font-size-12">{{ $order->charts }}</span></td>
        </tr>
    @endif
    @if($order->requires_digital_references)
        <tr>
            <td><strong>@lang('order.digital_references')</strong>:</td>
            <td><span class="badge badge-default font-size-12">@lang('order.yes')</span></td>
        </tr>
    @endif
    @if($order->plagiarism_report)
        <tr>
            <td><strong>@lang('order.plagiarism_report')</strong>:</td>
            <td><span class="badge badge-default font-size-12">@lang('order.yes')</span></td>
        </tr>
    @endif
    @if($order->grammar_report)
        <tr>
            <td><strong>@lang('order.grammar_report')</strong>:</td>
            <td><span class="badge badge-default font-size-12">@lang('order.yes')</span></td>
        </tr>
    @endif
    @if($order->requires_enl_writer)
        <tr>
            <td><strong>@lang('order.native_writer')</strong>:</td>
            <td><span class="badge badge-default font-size-12">@lang('order.yes')</span></td>
        </tr>
    @endif
    @if($order->related_orders)
        <tr>
            <td><strong>@lang('order.related_orders')</strong>:</td>
            <td>
                @foreach($order->related_orders as $relatedOrder)
                    <a href="{{ route('orders.show',['id'=>$relatedOrder]) }}">
                        <span class="badge badge-default font-size-12">#{{ $relatedOrder }}</span>
                    </a>
                @endforeach
            </td>
        </tr>
    @endif
    <tr>
        <td colspan="2">
            <h4 class="margin-top-0">@lang('order.instructions')</h4>
            {!! nl2br(strip_tags($order->instructions,'<strong><p>')) !!}
        </td>
    </tr>
    </tbody>
</table>
