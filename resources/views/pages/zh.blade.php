@extends('layouts.chinapage')
@section('title', "Best Essay Writing Service Platform
")
@section('meta')
<meta name="title" content="Order High-Quality Essay Writing Service"/>
<meta name="keywords" content="quality essays, professional essay, essay writer, professional essay writer, flawless essay writing, essay editing, essay assignments, essay writing services"/>
<meta name="description" content="Need help with essay writing? Get essay writing services from the best online essay writers."/> 
<meta name="robots" content="index, follow" />
<link rel="canonical" href="https://mycustomessays.com/zh" />
<meta name="twitter:title" content="Get Quality Essays"/>
<meta name="twitter:description" content="Need help with essay writing? Get essay writing services from the best online essay writers."/>
<meta name="twitter:card" content="Summary" />
<meta name="twitter:image" content=" https://mycustomessays.com/images/best-custom-essay.jpg"/>
<meta name="twitter:url" content="https://mycustomessays.com/zh"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
<meta property="og:title" content="Get Quality Essays"/>
<meta property="og:description" content="Need help with essay writing? Get essay writing services from the best online essay writers."/>
<meta property="og:url" content="https://mycustomessays.com"/>
<meta property="article:section" content="World's Best Custom Essay Writing Service "/>
<meta property="og:image" content="https://mycustomessays.com/images/best-custom-essay.jpg" />   
<meta property="og:image:secure_url" content="https://mycustomessays.com/images/best-custom-essay.jpg" />
<meta property="og:image:type" content="image/jpg" />
<meta property="og:image:alt" content=" Get Quality Essays "/>
@endsection



@section('page')
    <section class=" py-5  banner-back">

        <div class="container">
            <div class="row margin-rem" >
                <div class="col-md-6">
                    <h1 class=" text-white  mt ml-0 mt-4  font-weight-bold font-rem3" >你的作业庒力很大, 时间很少,对吧</h1>
                    <h2 class="text-white mt-3 text-center">把你的作业交给我们,到外面享受阳光吧</h4>

                    <div class="d-block">

                        <button class=" btn btn-secondary rounded  text-center mt-5"><a class="text-white" href="{{url('/order')}}">
                            <h3 class="text-white font-weight-bold">下单</h3></a></button>

                        <button class=" btn btn-primary rounded text-center mt-5 bordersolid" ><a
                                class="text-white" href="{{ route('enquiry.create') }}"><h3
                                    class="text-white font-weight-bold">免费报价 </h3>
                            </a></button>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container bg-white">
            <h2 class=" text-center"><span></span>我们的优势 </h2>
            <div class="row mt-3 mb-5">
                <div class="col-md-3">
                    <div class="blocky  h-100 mt-2">
                        <img src="{{ asset('images/first.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">经验丰富的写手</h4>
                        <p class=" mr-2 mx-2">我们的写手来自英美加澳，母语是英语。我们不会雇用大学本科的写手，我们的写手都有硕士或者博士的学历。他们写的每一份作业，我们质检的同事都会仔细检查，确保质量优质，才会发给同学 </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="blocky mt-2 h-100">
                        <img src="{{ asset('images/plagiarism.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">百分百原创</h4>
                        <p class=" mr-2 mx-2">我们每一句都是原创的。我们不抄袭或一份作业给几个同学用。我们会用最新的原创检查工具确保你的作业是原创，优质以及在互联网上任何地方找不到</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="blocky mt-2  h-100">
                        <img src="{{ asset('images/time.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">准时交货 </h4>
                        <p class=" mr-2 mx-2">你的死线就迫在眉睫吗？别恐慌，我们在。我们的写手来自全球不同的时区，他们随时都可以开始写你的作业。他们可以少睡一点，吃饭快一点, 确保你可以准时交作业 </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="blocky mt-2 h-100">
                        <img src="{{ asset('images/support.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">24小时支援 </h4>
                        <p class=" mr-2 mx-2">我们的支援团队24小时工作，你的查询我们一定尽快回复。或者你也可以联系我们24小时在线的支援团队 </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light bg-fade">
        <div class="container ">
            <h2 class=" text-center"><span></span>服务流程</h2>
            <div class="row mt-3 mb-5">
                <div class="col-md-3">
                    <div class="  h-100">
                        <img src="{{ asset('images/one.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">你提供指示</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="  h-100">
                        <img src="{{ asset('images/two.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">安排写手</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="  h-100">
                        <img src="{{ asset('images/three.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">追踪作业状态</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class=" h-100">
                        <img src="{{ asset('images/four.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">下载作业</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <h2 class="text-center">作业收费表 </h2>
            <div class="row">
                <div class="col-md-8 ">
                    <div class="overflow-auto">

                        @include('pages.pricezh')
                    </div>
                </div>
                <div class="col-md-4 shadow ">
                    <h2>免费服务
                    </h2>
                        <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>免费24小时支援</p>
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>免费标题页</p>
                  
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>免费文献目录</p>

                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>免费引用格式</p>
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>免费无限次修改
                    </p>

                </div>
            </div>
        </div>
    </section>
  <!--<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                     @include('orders.partials.page_calculator')
                </div>
            </div>
        </div>
    </section>-->
  

@endsection
