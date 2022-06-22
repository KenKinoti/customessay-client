@extends('layouts.page')
@section('title', "Contact Us for help")
@section('meta')
<meta name="description"content="Our support are always 24/7  available for custom Essay help "/>
<meta name="title" content="Contact us for custom writing help"/>
<link rel="canonical" href=" https://mycustomessays.com/contact" />
<meta name="twitter:card" content="Summary" />
<meta name="robots" content="follow, index "/>
<meta name="twitter:url" content="https://mycustomessays.com/contact"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
@endsection



@if(\Illuminate\Support\Facades\App::environment('production'))
    @push('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {action: 'contact'}).then(function (token) {
                $("#captcha").val(token);
            });
        });
    </script>
    @endpush
@endif

@section('page')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center py-4">
                <h1 class="section-title mb-2 ">
                    Ask us any <span class="font-weight-normal"> question</span>
                </h1>
                <p class="mb-5 ">
                We are here to help you !!
                </p>
            </div>
            <div class="row">
                <div class="col-sm-6 bg-white">
                    <h5 class="py-4">Talk To Us</h5>
                    <form action="{{ route('contact.store')}}" method="post" class="validate-form">
                        @csrf()
                        <input type="hidden" name="captcha" id="captcha">
                        <div class="row">
                            <div class="col-sm-12 mb-6">
                                <div class="form-group">
                                    <label class="h6 small d-block ">
                                       Enter Your Name
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               name="name" id="name"
                                               data-rule-required="true"
                                               data-rule-maxlength="64"
                                               placeholder="John Doe" type="text">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                           <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 mb-6">
                                <div class="form-group">
                                    <label class="h6 small d-block ">
                                       Enter  Your Email Address
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group ">
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" id="email"
                                               data-rule-required="true"
                                               data-rule-email="true"
                                               placeholder="john@gmail.com" type="email">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                          <div class="col-sm-12 mb-6">
                                <div class="form-group">
                                    <label class="h6 small d-block ">
                                        Enter Your  Subject
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">
                                        <input class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                               name="subject" id="subject"
                                               data-rule-required="true"
                                               data-rule-maxlength="165"
                                               placeholder="Essay Paper" type="text">
                                    </div>
                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback">
                                           <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label class="h6 small d-block ">
                                        Enter Your Message
                                
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <textarea class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                          rows="4" name="message" id="message"
                                          data-rule-required="true"
                                          data-rule-maxlength="1000"
                                          placeholder="Hi there, I would like to ..."></textarea>
                            </div>
                            @if ($errors->has('message'))
                                <span class="invalid-feedback">
                                           <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="">
                            <button name="submit" type="submit" class="btn btn-warning btn-circled">
                                <i class="ti ti-envelope"></i>
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4 offset-sm-1">
                    <div class="mt-5">
                        <div class="py-3">
                            <h2><i class="ti ti-comment"></i> Chat</h2>
                            <p> We are online  24/7 through our chat widget on the screen.</p>
                        </div>
                        <div class="py-3">
                            <h2><i class="ti ti-email"></i> Email</h2>
                            <p>You can contact us on</p>
                            <p><strong>support@mycustomessays.com</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
