@extends('layouts.page')

@section('title', 'Email Password Reset')
@section('meta')
<meta name="description"content="Reset your password here to make your order"/>
<meta name="title" content="Email Password Resetting "/>
<link rel="canonical" href=" https://mycustomessays.com/password/reset" />
<meta name="twitter:card" content="Summary" />
<meta name="twitter:url" content="https://mycustomessays.com/password/reset"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
@endsection
@section('page')
    <div class="py-5 bg-light">
        <div class="container">
            <div class="ml-auto mr-auto w-40 mt-4 p-4 bg-white">
                <h1 class="text-center">@lang('passwords.password_reset')</h1>
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    @csrf()
                    <div class="form-group">
                        <label for="email" class="control-label">@lang('auth.form.email')</label>
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                 <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-circled">
                            <i class="ti ti-envelope"></i> @lang('passwords.send_link')
                        </button>
                    </div>
                    <p>@lang('passwords.have_an_account')
                        <a href="{{ route('register') }}">
                            @lang('passwords.sign_up')
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
