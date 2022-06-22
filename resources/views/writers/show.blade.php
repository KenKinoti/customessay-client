@extends('layouts.page')

@section('title', $writer->name)

@section('page')
    <section class="bg-transparent py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-2 text-center">
                                        <div class="m-auto w-md-75">
                                            @if($writer->hasMedia('avatars'))
                                                <img class="rounded-circle img-fluid"
                                                     src="{{ asset($writer->getFirstMediaUrl('avatars')) }}">
                                            @else
                                                <img class="rounded-circle img-fluid"
                                                     src="{{ asset('images/default-avatar.png') }}">
                                            @endif
                                        </div>
                                        <strong class="text-black-50 my-3">{{ $writer->name ?? '' }}</strong>
                                        <p class="m-0">
                                            @for($i=1; $i <= 10; $i++)
                                                @if($i <= $writer->writerProfile->rating )
                                                    <i class="ti ti-star text-warning"></i>
                                                @else
                                                    <i class="ti ti-star"></i>
                                                @endif
                                            @endfor
                                        </p>
                                        {{ $writer->writerProfile->rating }}/10
                                        <hr>
                                        <p>
                                            <small class="font-weight-bold"><span
                                                    class="text-black-50">MEMBER SINCE:</span>
                                                {{ $writer->created_at->format('d M,Y') ?? '' }}</small>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class=" card-blog  ">
                                        <h4>About</h4>
                                        <p>{{ $writer->writerProfile->about ?? '' }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="mx-2 mr-2 mt-2">
                            <h4>Professional Skills </h4>
                            <ul class="list-unstyled">
                                @foreach($writer->skill->selectedDisciplines() as $discipline)
                                    <li><i class="fa fa-check-square-o text-warning"
                                           aria-hidden="true"></i> {{ $discipline->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-2">
                    <div class=" h-100">
                        <h4 class="mx-2 mr-2 text-center mt-2">Client Reviews</h4>
                        @forelse($reviews as $review)
                            <div class="card mt-2">
                                <p class="mx-2 mr-2">{{ $review->comments }}</p>
                                <div class="ti-author">
                                    <div class="rating mx-2 mr-2">
                                        @for($i=1; $i <=5; $i++)
                                            @if($i <= $review->value)
                                                <i class="ti ti-star rating-color" ></i>
                                            @else
                                                <i class="ti ti-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <h5 class="mr-2 mx-2">  {{ $review->order->client->name }}</h5>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="ti ti-info-circle"></i> {{ __('There are no reviews at this time') }}
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
