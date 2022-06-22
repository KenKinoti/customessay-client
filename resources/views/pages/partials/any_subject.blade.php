<div class="row justify-content-center ">
    <h2>@lang('pages.section.order_any_subject')</h2>
    <div class="row justify-content-center top-30">
        <div class="col-lg-4 col-md-6">
            <div class="service-block media">
                <div class="service-inner-content media-body">
                    <h4 class="text-center "><img src="{{ asset('images/user.png') }}" alt=""
                                                  class="img-fluid img-responsive  radius"> <br>
                        @lang('pages.section.qualified_writers') </h4>


                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="service-block media">
                <div class="service-inner-content media-body">
                    <h4 class="text-center "><img src="{{ asset('images/free.png') }}" alt=""
                                                  class="img-fluid img-responsive  radius"> <br>
                        @lang('pages.section.plagiarism_free') </h4>


                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="service-block media">
                <div class="service-inner-content media-body">
                    <h4 class="text-center "><img src="{{ asset('images/clock.png') }}" alt=""
                                                  class="img-fluid img-responsive  radius"><br> <br>
                        @lang('pages.section.takes_few_minutes')
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="service-block media">
                <div class="service-inner-content media-body text-center">
                    <h4 class="text-center">
                        <a href="{{ route('orders.create') }}"
                           class="btn btn-warning btn-lg btn-circled">
                            <i class="ti ti-shopping-cart"></i>
                            @lang('order.make_order')
                        </a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
