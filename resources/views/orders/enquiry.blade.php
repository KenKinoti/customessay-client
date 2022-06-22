@extends('layouts.page')

@section('title', __('order.page.enquiry.title'))
@section('meta')
<meta name="description"content="My Custom Essay free enquiry order page. Get quality essay writing at affordable prices"/>
<meta name="title" content="Free order enquiry"/>
<link rel="canonical" href=" https://mycustomessays.com/order-enquiry" />
<meta name="twitter:card" content="Summary" />
<meta name="twitter:url" content="https://mycustomessays.com/order-enquiry"/>
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
                <form id="orderForm" action="{{ route('enquiry.store') }}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-8 bg-white">
                            @include('orders.shared.form')
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="ti ti-shopping-cart"></i>
                                    {{ __('Submit Enquiry') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sticky card mx-md-2">
                                <small
                                    class="card-title text-center text-black-50 text-uppercase py-3 font-weight-bold">
                                    @lang('order.form.summary_title')
                                </small>
                                <div class="card-body pt-0">
                                    @include('orders.partials.summary')
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('orders.partials.prices')
@endsection
