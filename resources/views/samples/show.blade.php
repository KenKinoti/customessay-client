@extends('layouts.page')

@section('title',$sample->title)

@section('meta')
    @if($sample)
        <meta name="description" content="{{$sample->mdescription}}"/>
        <meta name="robots" content="{{$sample->mrobots}}"/>
        <link rel="canonical" href="{{$sample->mcanonical}}"/>
        <meta name="twitter:title" content="{{$sample->msocialtitle}}"/>
        <meta name="twitter:description" content="{{$sample->msocialdescription}}"/>
        <meta name="twitter:card" content="{{$sample->twittercard}}"/>
        <meta name="twitter:url" content="{{$sample->twitterurl}}"/>
        <meta property="article:published_time" content="{{$sample->created_at}}"/>
        <meta property="article_updated_time" content="{{$sample->updated_at}}"/>
        <meta property="og:locale" content="{{$sample->oglocale}}"/>
        <meta property="og:type" content="{{$sample->ogtype}}"/>
        <meta property="og:title" content="{{$sample->ogtitle}}"/>
        <meta property="og:description" content="{{$sample->ogdescription}}"/>
        <meta property="og:url" content="{{$sample->ogurl}}"/>
        <meta property="article:section" content="{{$sample->articlesection}}"/>
    @endif
@endsection

@section('page')
    <section class="py-5 order bg-white bg-fade">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 bg-white shadow">
                    <h1 class="text-center">{{ $sample->title }}</h1>
                    {!! $sample->description !!}
                </div>
                <div class="col-lg-4 static">
                    <div class="bg-light sticky p-2 my-5 shadow">
                        <div class="mt-3 sticky">
                            <h4> {{ $sample->title }}</h4>
                            <p><strong
                                     classs="sample-color">@lang('sample.discipline')</strong>: {{ $sample->discipline->name }}
                            </p>

                            <p><strong  classs="sample-color">@lang('sample.academic_level')</strong>: {{ $sample->academicLevel->name }}</p>
                            <p><strong  classs="sample-color">@lang('sample.paper_format')</strong>: {{ $sample->format }}
                            </p>
                            <p><strong  classs="sample-color">@lang('sample.sources')</strong>:{{ $sample->sources }} </p>
                            <p><strong  classs="sample-color">@lang('sample.pages')</strong>: {{ $sample->pages }}</p>
                            <h4>@lang('sample.instructions')</h4>
                            <p>{{ $sample->instruction }}</p>

                            <button class=" btn btn-primary rounded  mt-4"><a class="text-white text-lowercase"
                                                                              href="{{url('/order')}}"><h5
                                        class="text-white">@lang('sample.order_like_this')
                                    </h5></a></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('pages.partials.steps')
@stop

@section('script')
    <script type="javascript">
        var disqus_config = function () {
            this.page.url = "{{ url('sample',$sample->slug) }}";
            this.page.identifier = Number('{{ $sample->id }}');
        };
        (function () {
            var d = document, s = d.createElement('script');
            s.src = '//{{ config('system.discuss_name') }}.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@append


