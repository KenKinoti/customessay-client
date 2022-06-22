<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="javascript: void(0)" data-toggle="tab" data-target="#new" class="nav-link active"
           aria-expanded="true">
            @lang('order.form.register') 
        </a>
    </li>
    <li class="nav-item">
        <a href="javascript: void(0)" data-toggle="tab" data-target="#return" class="nav-link"
           aria-expanded="true">
            @lang('order.form.log_in') 
        </a>
    </li>
</ul>
<div class="tab-content p-3">
    <div id="new" class="tab-pane active">
        <input type="hidden" name="timezone" class="timezone">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="row">
                <label for="name" class="col-sm-3 control-label">
                    @lang('auth.form.name') 
                </label>
                <div class="col-sm-9">
                    <input id="name" type="text" class="form-control" name="name"
                           value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="row">
                <label for="email" class="col-sm-3 control-label">
                    @lang('auth.form.email') 
                </label>
                <div class="col-sm-9">
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="row">
                <label for="password" class="col-sm-3 control-label">
                    @lang('auth.form.password') 
                </label>
                <div class="col-sm-9">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="password_confirmation" class="col-sm-3 control-label">
                    @lang('auth.form.confirm_password') 
                </label>
                <div class="col-sm-9">
                    <input id="password_confirmation" type="password" class="form-control"
                           name="password_confirmation">
                </div>
            </div>
        </div>
        <div class="text-center mt-5">@lang('order.form.checkout_text') </div>
        <div class="text-center">@lang('order.form.have_account')  
            <a href="javascript: void(0)" data-toggle="tab" data-target="#return">
                @lang('order.form.log_in') 
            </a>
        </div>
    </div>
    <div id="return" class="tab-pane">
        <div class="form-group">
            <div class="row">
                <label for="email" class="col-sm-3 control-label">
                    @lang('auth.form.email') 
                </label>
                <div class="col-sm-9">
                    <input id="login-email" type="email" class="form-control" value="{{ old('email') }}"
                           name="login_email">
                    <span id="error-message" class="text-danger font-size-12"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="password" class="col-sm-3 control-label">
                    @lang('auth.form.password') 
                </label>
                <div class="col-sm-9">
                    <input id="login-password" type="password" class="form-control"
                           name="login_password">
                </div>
            </div>
        </div>
        <div class="text-center margin-top-20">@lang('order.form.no_account') 
            <a href="javascript: void(0)" data-toggle="tab" data-target="#new">
                @lang('order.form.register') 
            </a>
        </div>
    </div>
</div>
