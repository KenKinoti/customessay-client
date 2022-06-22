@extends('layouts.app')

@section('title','Profile Settings')

@section('app')
    <div class="row">
        <div class="col-sm-6">
            <form id="change-password" action="{{ route('update-password') }}" method="post">
                @csrf()
                @method('put')
                <div class="card">
                    <div class="card-header bg-light">
                        <h4 class="m-0"><i class="ti ti-settings"></i> @lang('profile.change_password')</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group{{ $errors->has('current_password')?" has-error":"" }}">
                            <label for="current_password">@lang('profile.current_password')</label>
                            <input type="password" name="current_password" class="form-control">
                            @if ($errors->has('current_password'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('new_password')?" has-error":"" }}">
                            <label for="current_password">@lang('profile.new_password')</label>
                            <input type="password" id="new_password" name="new_password" class="form-control">
                            @if ($errors->has('new_password'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('new_password_confirmation')?" has-error":"" }}">
                            <label for="current_password">@lang('profile.confirm_password')</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                            @if ($errors->has('new_password_confirmation'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-save"></i> @lang('profile.change_password')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
