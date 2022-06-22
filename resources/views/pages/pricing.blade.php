@extends('layouts.page')
@section('title', "Academic Writing Services at Affordable Prices ")
@section('meta')
<meta name="title" content="Affordable Homework Writing Help"/>
<meta name="keywords" content="affordable homework help, cheap assignments, affordable prices, resonable prices, cheap homework, affordable essay writing, cheap tutoring services, pocket-friendly writing services, budget-friendly homework help"/>
<meta name="description" content="Are you looking for an affordable assignment help platform? MyCustomEssays.com offers cheap homework and tutoring services. Save a lot with our quality but budget-friendly homework help services."/> 
<meta name="robots" content="index, follow" />
<link rel="canonical" href=" https://mycustomessays.com/pricing" />
<meta name="twitter:title" content="Affordable Homework Writing Help"/>
<meta name="twitter:description" content="Are you looking for an affordable assignment help platform? MyCustomEssays.com offers cheap homework and tutoring services. Save a lot with our quality but budget-friendly homework help services."/>
<meta name="twitter:card" content="Summary" />
<meta name="twitter:image" content=" https://mycustomessays.com/images/pricing.jpg"/>
<meta name="twitter:url" content="https://mycustomessays.com"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
<meta property="og:title" content="Affordable Homework Writing Help"/>
<meta property="og:description" content="Are you looking for an affordable assignment help platform? MyCustomEssays.com offers cheap homework and tutoring services. Save a lot with our quality but budget-friendly homework help services."/>
<meta property="og:url" content="https://mycustomessays.com/pricing"/>
<meta property="article:section" content="Affordable Homework Writing Help "/>
<meta property="og:image" content="https://mycustomessays.com/images/pricing.jpg" />   
<meta property="og:image:secure_url" content="https://mycustomessays.com/images/pricingy.jpg" />
<meta property="og:image:type" content="image/jpg" />
<meta property="og:image:alt" content=" Affordable Homework Writing Help "/>
@endsection



@section('page')
   <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   <h1>{{ __('The Most') }} <span class="text-primary price-font" >{{ __('RESONABLE PRICES') }}</span>
{{ __('on the Market!') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                 <div class="rounded">
                      @include('orders.partials.page_calculator')
                 </div>
                </div>
                <div class="col-md-4">
                <p class="mt-5">{{ __('Our professional team of writers ensures that our customers get the best bang for their buck. Simply stated, we are the best custom essay writing service provider in the industry.') }} </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center">{{ __('PRICE') }}</h2>
            <p>{{ __('We offer very competitive prices for our services. Our order pricing system is mainly based on the urgency of a paper, its length and complexity') }} </p>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    @include('pages.price')
                </div>
            </div>
        </div>
    </section>


    @include('pages.partials.steps')
     
    
@endsection
