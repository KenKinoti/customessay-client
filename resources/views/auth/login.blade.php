@extends('layouts.page')
@section('title','Login page')
@section('meta')
<meta name="description"content="My Custom Essay Login page. Get quality essay writing at affordable prices"/>
<meta name="title" content="Login Page"/>
<link rel="canonical" href=" https://mycustomessays.com/login" />
<meta name="twitter:card" content="Summary" />
<meta name="twitter:url" content="https://mycustomessays.com/login"/>
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
    <section class="py-5  bg-light">
        <div class="container">
            <div class="row">
                <div class="ml-auto mr-auto w-100 mt-4 p-4 bg-white col-md-8 offset-2">
                    <div class="custom-tabs">
                        <ul class="nav nav-tabs nav-fill">
                            <li class="nav-item">
                                <a href="#tab01" data-toggle="tab" class="nav-link active">
                                    @lang('auth.form.returning_customer')
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#tab03" data-toggle="tab" class="nav-link">
                                    @lang('auth.form.new_customer')
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content px-4 py-3 border-left border-bottom border-right">
                            <div id="tab01" class="tab-pane active">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf()
                                    <div class="form-group">
                                        <label for="login_email" class="control-label">
                                            @lang('auth.form.email')
                                        </label>
                                        <input id="login_email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email"
                                               value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="login_password" class="control-label">
                                            @lang('auth.form.password')
                                        </label>
                                        <input id="login_password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">
                                                @lang('auth.form.remember_me')
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row mt-4 align-items-center">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary btn-circled">
                                                <i class="ti ti-unlock"></i> @lang('auth.form.sign_in')
                                            </button>
                                        </div>
                                        <div class="col text-right">
                                            <a href="{{ route('password.request') }}">
                                                @lang('auth.form.forgot_password')
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="tab03" class="tab-pane">
                                <form id="register" class="form-horizontal" method="POST"
                                      action="{{ route('register') }}">
                                    @csrf()
                                    <input type="hidden" name="timezone" class="timezone">
                                    <input type="hidden" name="captcha" id="captcha">
                                    <div class="form-group">
                                        <label for="name" class="control-label">
                                            @lang('auth.form.name')
                                        </label>
                                        <input id="name" type="text"
                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               name="name" value="{{ old('name') }}" autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                               <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label">
                                            @lang('auth.form.email')
                                        </label>
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email"
                                               value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label">
                                            @lang('auth.form.password')
                                        </label>
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                 <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" class="control-label">
                                            @lang('auth.form.confirm_password')
                                        </label>
                                        <input id="password_confirmation" type="password" class="form-control"
                                               name="password_confirmation">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-circled">
                                            <i class="ti ti-edit"></i> @lang('auth.form.register')
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
