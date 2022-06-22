@foreach($order->disputes as $dispute)
    <div class="comments">
        <a data-toggle="collapse" href="#collapse{{ $dispute->id }}">{{ $dispute->subject }}</a>
        <div class="collapse" id="collapse{{ $dispute->id }}">
            <div class="comment">
                {!! nl2br(strip_tags($dispute->comments,'<strong><p>')) !!}
            </div>
        </div>
        <div class="time">
            {{ $dispute->created_at }}
        </div>
    </div>
@endforeach