@if ($errors->has('totalAmount'))
    <div class="alert alert-danger alert-dismissible margin-top-10" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ti ti-window-close margin-right-15"></i>
        </button>
        <strong>@lang('alert.error')</strong> {{ $errors->first('totalAmount') }}
    </div>
@endif
@if ($errors->has('unauthenticated'))
    <div class="alert alert-danger alert-dismissible margin-top-10" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ti ti-window-close margin-right-15"></i>
        </button>
        <strong>@lang('alert.error')</strong> {{ $errors->first('unauthenticated') }}
    </div>
@endif
