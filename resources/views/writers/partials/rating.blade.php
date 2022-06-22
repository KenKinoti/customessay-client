<p>
    @for($i=1; $i <= 10; $i++)
        @if($i <= $writer->writerProfile->rating )
            <i class="ti ti-star text-warning"></i>
        @else
            <i class="ti ti-star"></i>
        @endif
    @endfor
</p>
@if($writer->writerProfile->rating)
    <p class="m-0">{{ $writer->writerProfile->rating  }}/10</p>
@else
    <span class="badge badge-success">
        <i class="ti ti-star text-warning"></i>
        New Writer
    </span>
@endif
