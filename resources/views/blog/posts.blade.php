@extends('layouts.page')

@section('title','Quality Custom Essay Writing Guides Blog')

@section('meta')
<meta name="description"content="Welcome to mycustomessays Blog! Are you in search of pieces of top-notch content?"/>
<meta name="title" content="Get your order at affordable prices, check our blog we provide tips of quality content"/>
<link rel="canonical" href=" https://mycustomessays.com/blog" />
<meta name="twitter:card" content="Summary" />
<meta name="twitter:url" content="https://mycustomessays.com/blog"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
@stop

@section('page')
    <section class="py-3">
        <div class="container">
            <div class="d-flex justify-content-between pb-3 align-items-center mb-2 border-bottom border-gray">
                <h1 class="text-black-50 text-uppercase mt-1">@lang('blog.latest_posts')</h1>
                <form method="get" action="{{ route('search') }}" class="col-4 pl-3 p-0">
                    <input type="text" name="item" placeholder="@lang('blog.search_blog')" class="form-control">
                </form>
            </div>
            <div class="row align-items-baseline mt-3">
                @forelse($posts as $post)
                    <div class="col-lg-4 col-md-6 mb-3 ">
                        <div class="blog-box card">
                            @if($post->hasMedia('featured'))
                                <div class="blog-img-box">
                                    <img src="{{ asset($post->getFirstMediaUrl('featured')) }}"
                                         alt="{{$post->ogimagealt}}"
                                         class="img-fluid">
                                </div>
                            @endif
                            <div class="single-blog">
                                <div class="blog-content">
                                    <h6 class="badge badge-warning">{{ $post->category->name }}</h6>
                                    <a href="{{ url('blog',$post->slug)}}">
                                        <h3 class="card-title">{{ $post->title }}</h3>
                                    </a>
                                    <p>{!! \Illuminate\Support\Str::limit(strip_tags($post->content),'180','....') !!}</p>
                                    <a href="{{ url('blog',$post->slug)}}" class="btn btn-sm btn-primary btn-circled">
                                        @lang('blog.read_more')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i> @lang('blog.no_posts')
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
