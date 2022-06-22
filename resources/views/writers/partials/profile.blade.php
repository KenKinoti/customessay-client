<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-12 text-left">
        <a href="{{ route('experts.show',['id' => $writer->id]) }}">
            @if($writer->hasMedia('avatars'))
                <img class="rounded-circle img-fluid" 
                     src="{{ asset($writer->getFirstMediaUrl('avatars')) }}">
            @else
                <img class="rounded-circle img-fluid" 
                     src="{{ asset('images/default-avatar.png') }}">
            @endif
        </a>
    </div>
    <div class="col-lg-9 col-md-8 col-sm-12 text-left text-black-50">
        <a href="{{ route('experts.show',['id' => $writer->id]) }}"
           class="text-dark">
            <p class="mb-1">{{ $writer->name }}</p>
        </a>
      
    </div>
</div>
