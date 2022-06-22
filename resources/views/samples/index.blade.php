@extends('layouts.page')

@section('title','Samples of assignment  done')

@section('meta')
<meta name="description"content="We provide free samples of cheap essays and assignments "/>
<meta name="title" content="Get your order at affordable prices "/>
<link rel="canonical" href=" https://mycustomessays.com/samples" />
<meta name="twitter:card" content="Summary" />
<meta name="twitter:url" content="https://mycustomessays.com/samples"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
@stop

@section('page')
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">@lang('sample.heading')</h1>
                    <p class="text-center">
                        @lang('sample.description')
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3">
        <div class="container">
            <div class="d-flex justify-content-between pb-3 align-items-center mb-2 border-bottom border-gray">
                <h6 class="text-black-50  mt-1">@lang('sample.check_latest')</h6>
                <form method="get" action="{{ route('samples.index') }}" class="col-4 pl-3 p-0">
                    <input type="text" name="item" placeholder="@lang('sample.search')" class="form-control">
                </form>
            </div>
            <div class="row align-items-baseline mt-3">
                @forelse($samples as $sample)
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="blog-box shadow-lg rounded">

                            <div class="single-blog bg-primary">
                                <a href="{{ url('blog',$sample->slug)}}">
                                    <h3 class="card-title text-white">{!! \Illuminate\Support\Str::limit(strip_tags($sample->paperType->name),'22','...') !!}</h3>
                                </a>
                            </div>

                            <div class="single-blog">
                                <p><strong class="sample-color">@lang('sample.paper_title')</strong>: {!! \Illuminate\Support\Str::limit(strip_tags($sample->title),'25','....') !!}
                                </p>
                                <p><strong class="sample-color">@lang('sample.discipline')</strong>: {{ $sample->discipline->name }}
                                </p>

                                <p><strong class="sample-color">@lang('sample.academic_level')</strong>: {{ $sample->academicLevel->name }}
                                </p>
                                <p><strong class="sample-color">@lang('sample.pages')</strong>: {{ $sample->pages }}
                                </p>


                                <p>{!! \Illuminate\Support\Str::limit(strip_tags($sample->content),'180','....') !!}</p>
                                <button class="sample-button">
                                    <a class="nav-link" href="{{ url('samples',$sample->slug)}}"><span
                                            class="pb_rounded-4 px-4 text-black"> @lang('sample.view_sample')  <i
                                                class="ti ti-arrow-right text-primary"></i></span></a></button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i> @lang('sample.no_samples')
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $samples->links() }}
            </div>
        </div>
    </section>
@endsection


