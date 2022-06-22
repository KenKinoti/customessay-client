@if($reviews->count())
    <div class="carousel slide testimonial-slider" data-ride="carousel">
        @foreach($reviews as $review)
            <div class="carousel-item @if($loop->first) active @endif">
                <p>{{ $review->comments }}</p>
                <div class="ti-author">
                    <div class="rating">
                        @for($i=1; $i <=5; $i++)
                            @if($i <= $review->value)
                                <i class="ti ti-star yellow"></i>
                            @else
                                <i class="ti ti-star"></i>
                            @endif
                        @endfor
                    </div>
                    <p class="font-weight-bold"> - {{ $review->order->client->name }}</p>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">
        <i class="ti ti-info-circle"></i> {{ __('There are no reviews at this time') }}
    </div>
@endif
