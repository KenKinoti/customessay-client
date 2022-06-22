@extends('layouts.page')

@section('title', 'Sign Up page')
@section('meta')
<meta name="description"content="My Custom Essay Register page"/>
<meta name="title" content="Register Page"/>
<link rel="canonical" href=" https://mycustomessays.com/register" />
<meta name="twitter:card" content="Summary" />
<meta name="twitter:url" content="https://mycustomessays.com/register"/>
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
    <div class="py-5">
        <div class="container">
            <div class="ml-auto mr-auto w-100 mt-4 p-4">
                <h1 class="text-center">Register</h1>
                <form id="register" class="form-horizontal" method="POST" action="{{ route('register') }}">
                    @csrf()
                    <input type="hidden" name="timezone" class="timezone">
                    <input type="hidden" name="captcha" id="captcha">
                    <div class="form-group">
                        <label for="name" class="control-label">@lang('auth.form.name')</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                               <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">@lang('auth.form.email')</label>
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">@lang('auth.form.password')</label>
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                 <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="control-label">@lang('auth.form.confirm_password')</label>
                        <input id="password_confirmation" type="password" class="form-control"
                               name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-circled">
                            <i class="ti ti-edit"></i> @lang('auth.form.register')
                        </button>
                    </div>
                </form>
                <p>Forgot your password?
                    <a href="{{ route('password.request') }}">
                        @lang('auth.form.reset')
                    </a>
                </p>
                <p>Already have an account?
                    <a href="{{ route('login') }}">
                        @lang('auth.form.sign_in')
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
