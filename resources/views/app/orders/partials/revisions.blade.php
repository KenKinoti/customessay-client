@foreach($order->revisions as $revision)
    <div class="comments">
        <a data-toggle="collapse" href="#collapse{{ $revision->id }}">{{ $revision->subject }}</a>
        <div class="collapse" id="collapse{{ $revision->id }}">
            <div class="comment">
                {!! nl2br(strip_tags($revision->comments,'<strong><p>')) !!}
            </div>
        </div>
        <div class="time">
            {{ $revision->created_at }}
        </div>
    </div>
@endforeach