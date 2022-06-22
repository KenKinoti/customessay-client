@extends('layouts.page')

@section('title',$service->mtitle)

@section('meta')
    @if($service)
        <meta name="description" content="{{$service->mdescription}}"/>
        <meta name="robots" content="{{$service->mrobots}}"/>
        <link rel="canonical" href="{{$service->mcanonical}}"/>
        <meta name="twitter:title" content="{{$service->msocialtitle}}"/>
        <meta name="twitter:description" content="{{$service->msocialdescription}}"/>
        <meta name="twitter:card" content="{{$service->twittercard}}"/>
        <meta name="twitter:url" content="{{$service->twitterurl}}"/>
        <meta property="article:published_time" content="{{$service->created_at}}"/>
        <meta property="article_updated_time" content="{{$service->updated_at}}"/>
        <meta property="og:locale" content="{{$service->oglocale}}"/>
        <meta property="og:type" content="{{$service->ogtype}}"/>
        <meta property="og:title" content="{{$service->ogtitle}}"/>
        <meta property="og:description" content="{{$service->ogdescription}}"/>
        <meta property="og:url" content="{{$service->ogurl}}"/>
        <meta property="article:section" content="{{$service->articlesection}}"/>
    @endif
@endsection

@section('page')
    
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12  card">
                    <h2>{{ $service->title }}</h2>
                    <div class="content">
                        {!! $service->description !!}
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
            this.page.url = "{{ url('service',$service->slug) }}";
            this.page.identifier = Number('{{ $service->id }}');
        };
        (function () {
            var d = document, s = d.createElement('script');
            s.src = '//{{ config('system.discuss_name') }}.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@append
