@extends('layouts.page')

@section('title',$post->mtitle)

@section('meta')
    @if($post)
        <meta name="description" content="{{$post->mdescription}}"/>
        <meta name="robots" content="{{$post->mrobots}}"/>
        <link rel="canonical" href="{{$post->mcanonical}}"/>
        <meta name="twitter:title" content="{{$post->msocialtitle}}"/>
        <meta name="twitter:description" content="{{$post->msocialdescription}}"/>
        <meta name="twitter:card" content="{{$post->twittercard}}"/>
        <meta name="twitter:image" content="{{$post->twitterimage}}"/>
        <meta name="twitter:url" content="{{$post->twitterurl}}"/>
        <meta property="article:published_time" content="{{$post->created_at}}"/>
        <meta property="article_updated_time" content="{{$post->updated_at}}"/>
        <meta property="og:locale" content="{{$post->oglocale}}"/>
        <meta property="og:type" content="{{$post->ogtype}}"/>
        <meta property="og:title" content="{{$post->ogtitle}}"/>
        <meta property="og:description" content="{{$post->ogdescription}}"/>
        <meta property="og:url" content="{{$post->ogurl}}"/>
        <meta property="article:section" content="{{$post->articlesection}}"/>
        <meta property="og:image" content="{{$post->ogimage}}"/>
        <meta property="og:image:secure_url" content="{{$post->ogimgsecureurl}}"/>
        <meta property="og:image:type" content="{{$post->ogimagetype}}"/>
        <meta property="og:image:alt" content="{{$post->ogimagealt}}"/>
    @endif
@endsection

@section('page')
    <section class="py-3">
        <div class="container">
            <div class="order">
                <div class="row">
                    <div class="col-md-8  card">
                        <div class="pt-4 px-2">
                            <h1>{{ $post->title }}</h1>
                            <strong class="text-black-50 d-block">
                            <span><i class="ti ti-time" aria-hidden="true"></i>
                            </span> {{ $post->created_at->format('d F Y')  }}
                            </strong>
                            <img class="img-fluid mb-2 mt-2" src="{{ asset($post->getFirstMediaUrl('featured')) }}"
                                 alt="{{$post->ogimagealt}}">

                            {!! $post->content !!}
                        </div>
                        <hr>
                        <div id="disqus_thread"></div>
                    </div>
                    <div class="col-md-4">
                        @include('pages.partials.sidebars')
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@stop
@section('script')
    <script type="javascript">
        var disqus_config = function () {
            this.page.url = "{{ url('blog',$post->slug) }}";
            this.page.identifier = '{{ $post->slug }}';
        };
        (function () {
            var d = document, s = d.createElement('script');
            s.src = '//{{ config('system.discuss_name') }}.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@append
