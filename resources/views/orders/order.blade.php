@extends('layouts.page')

@section('title', __('order.page.create.title'))
@section('meta')
<meta name="description"content="Order cheap assignment  writing service from our experties"/>
<meta name="title" content="Order your paper now and get it done before instant"/>
<link rel="canonical" href=" https://mycustomessays.com/order" />
<meta name="twitter:card" content="Summary" />
<meta name="twitter:url" content="https://mycustomessays.com/order"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
@endsection
@section('page')
    <div class="py-5 bg-light">
        <div class="container">
            <div class="order">
                @include('orders.partials.error')
                <form id="orderForm" action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-8 bg-white">
                            @include('orders.shared.form')
                        </div>
                        <div class="col-md-4">
                            @include('orders.shared.checkout')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
