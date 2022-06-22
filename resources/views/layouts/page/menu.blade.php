   <!-- end --><header id="pageNav">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-lg " id="pb-navbar">
        <div class="container">
            <a href="{{ url('/') }}"> <img src="{{asset('images/logo.png')}}" class="img-fluid"
                                            alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nvbCollapse"
                    aria-controls="nvbCollapse">
                <i class="ti ti-align-justify text-primary" aria-hidden="true"> </i>
            </button>
            <div class="collapse navbar-collapse" id="nvbCollapse">
                <ul class="navbar-nav ml-auto ">
           <li class="nav-item dropdown mt-1">
                    <a class="nav-link dropdown-toggle text-dark" data-toggle="dropdown" href="#">Services</a>
                    <div class="dropdown-menu">
                        <div class="container">
                        <div class="row card shadow-lg">
                           
                            <div class="col-lg-6">
                                 
                                    

                            <a class="dropdown-item mt-n2" href="{{ url('homework-help') }}">{{ __('Homework Help') }}</a>
                            <a class="dropdown-item mt-n2" href="{{ url('annotated-bibliography-writing') }}">{{ __(' Bibliography Writing') }}</a>              
                            <a class="dropdown-item mt-n2" href="{{ url('term-paper-writing') }}">{{ __('Term Paper Writing') }}</a>  
                            <a class="dropdown-item mt-n2" href="{{ url('speech-writing') }}">{{ __('Speech Writing') }}</a>  
                            <a class="dropdown-item mt-n2" href="{{ url('thesis-writing') }}">{{ __('Thesis Writing') }}</a> 
 <a class="dropdown-item mt-n2 mt-2 " href="{{ url('editing-and-proofreading')}}">{{ __('Editing & Proofreading services') }}</a>
</div>
<div class="col-lg-6">
                              
                            <a class="dropdown-item mt-n2" href="{{ url('research-proposal-writing') }}">{{ __('Reseach Proposal Writing') }}</a>
                            <a class="dropdown-item mt-n2" href="{{ url('research-paper-writing') }}">{{ __('Research Paper Writing') }}</a>
                            <a class="dropdown-item mt-n2" href="{{ url('powerpoint-presentation') }}">{{ __('Powerpoint Presenation') }}</a>

                           <a class="dropdown-item mt-n2" href="{{ url('article-review-writing') }}">{{ __('Article Review Writing') }}</a>
                           <a class="dropdown-item mt-n2" href="{{ url('dissertation-writing') }}">Dissertation Writing Services</a> 
                            <a class="dropdown-item mt-n2" href="{{ url('grant-proposal-writing') }}">{{ __('Grant Proposal Writing') }}</a>
                           <a class="dropdown-item mt-n2" href="{{ url('essay-writing') }}">{{ __('Essay Writing') }}</a>
                           <a class="dropdown-item mt-n2" href="{{ url('case-study') }}">{{ __('Case Study') }}</a> 
                            <a class="dropdown-item mt-n2" href="{{ url('admission-essay-writing') }}">Admission Essay Writing</a> 
                            <a class="dropdown-item mt-n2" href="{{ url('lab-report-writing') }}">Lab Report Writing</a>
                            
                            </div>
                    </div>
                </li>
                    <li class="nav-item mt-1"><a class="nav-link text-dark" href="{{ url('pricing') }}">
                            @lang('nav.page.pricing')</a>
                    </li>
                    <li class="nav-item mt-1"><a class="nav-link text-dark" href="{{url('writers')}}">
                            @lang('nav.page.writers')</a></li>
                    <li class="nav-item mt-1"><a class="nav-link text-dark" href="{{url('samples')}}">
                            @lang('nav.page.samples')
                        </a></li>
                    <li class="nav-item mt-1"><a class="nav-link text-dark" href="{{url('blog')}}">
                      {{ __(' Blog ') }}
                        </a>
                    </li>




                    @if(Auth::check())
                        <li class="nav-item cta-btn ml-xl-2 ml-lg-2  mt-1 btn-secondary pb_rounded-4 ml-md-0 ml-sm-0 ml-0 rounded"
                          ><a class="nav-link" href="{{url('/order')}}"><span
                                    class="pb_rounded-4  cta"><i class="fa fa-cart-arrow-down"
                                                                     aria-hidden="true"></i>
                                @lang('nav.page.order_now')</span></a></li>


                        <li class="nav-item mt-1 ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0  dashboard-button  "
                        >
                            <a class="nav-link" href="{{ route('dashboard') }}"><span
                                    class="pb_rounded-4 px-4 cta text-primary">
                                {{ __('Dashboard') }}</span></a></li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                @if(Auth::user()->hasMedia('avatars'))
                                    <img class="rounded-circle img-fluid ml-1 height-32" 
                                         src="{{ asset(Auth::user()->getFirstMediaUrl('avatars')) }}">
                                @else
                                    <img class="rounded-circle img-fluid ml-1 height-32" 
                                         src="{{ asset('images/default-avatar.png') }}">
                                @endif
                                {{ first_name(Auth::user()->name) }}
                                <b class="caret"></b>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right w-25">
                                <a href="{{ route('profile') }}" class="dropdown-item"><i
                                        class="ti ti-user"></i> Profile</a>
                                <a href="{{ route('settings') }}" class="dropdown-item"><i
                                        class="ti ti-settings"></i>
                                    @lang('nav.page.settings')</a>
                                <hr class="divider m-0">
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault(); document.getElementById('logout').submit();">
                                    <i class="ti ti-power-off"></i> @lang('nav.page.log_out')
                                </a>
                                <form id="logout" method="post" action="{{ route('logout') }}"
                                      class="none">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item cta-btn ml-xl-2 ml-lg-2  mt-1 btn-secondary pb_rounded-4 ml-md-0 ml-sm-0 ml-0 rounded"
                          ><a class="nav-link" href="{{url('/order')}}"><span
                                    class="pb_rounded-4 px-4 cta"><i class="fa fa-cart-arrow-down"
                                                                     aria-hidden="true"></i>
                                @lang('nav.page.order_now')</span></a></li>
                        <li class="nav-item mt-1 ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0   dashboard-button"
                        >
                            <a class="nav-link" href="{{url('/login')}}"><span
                                    class="pb_rounded-4 px-4 cta text-primary">
                                @lang('nav.page.manage_orders')</span></a></li>

                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

