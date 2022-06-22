@extends('layouts.page')

@section('title', 'Recover Your  Password')
@section('meta')
<meta name="description"content="We provide quality cheap eassy"/>
<meta name="title" content="Password resetting "/>
<link rel="canonical" href=" https://mycustomessays.com/password/reset" />
<meta name="twitter:card" content="Summary" />
<meta name="twitter:url" content="https://mycustomessays.com/password/reset"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
@stop
@section('page')
    <div class="py-5 bg-light">
        <div class="container">
            <div class="ml-auto mr-auto w-40 mt-4 p-4 bg-white">
                <h3 class="text-center">@lang('passwords.reset_password')</h3>
                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                    @csrf()
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" class="form-control" name="email" value="{{ $email }}">
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">@lang('auth.form.password')</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="control-label">@lang('auth.form.confirm_password')</label>
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-circled">
                            <i class="ti ti-save"></i> @lang('passwords.reset_password')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
