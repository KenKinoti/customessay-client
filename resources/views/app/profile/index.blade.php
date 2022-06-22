@extends('layouts.app')

@section('title','Profile')

@section('app')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <div class="card-body">
                    <div class="profile">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="avatar">
                                    @if($user->hasMedia('avatars'))
                                        <img class="img-circle img-fluid"
                                             src="{{ asset($user->getFirstMediaUrl('avatars')) }}">
                                    @else
                                        <img class="img-circle img-fluid"
                                             src="{{ asset('images/default-avatar.png') }}">
                                    @endif
                                </div>
                                <div class="profile-info">
                                    <h3 class="margin-top-0 margin-bottom-0">{{ $user->name }}</h3>
                                    <div class="user_type">
                                        <i class="ti ti-briefcase"></i>
                                        {{ $user->userType->name }}
                                    </div>
                                    <div class="status">
                                        @include('app.profile.partials.status')
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="actions">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editProfile">
                                        <i class="ti ti-pencil-alt"></i> @lang('profile.edit_profile')
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr class="margin-bottom-0">
                        <div class="full-profile">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#tab1" class="nav-link active" data-toggle="tab">
                                        @lang('profile.general')
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab1" class="tab-pane active">
                                    @include('app.profile.partials.general')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="editProfile" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editProfile" method="post" action="{{ route('profile.update') }}">
                    @csrf()
                    @method('PUT')
                    <div class="modal-header">
                        <h4>@lang('profile.edit_profile')</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group margin-top-0">
                            <label for="phone">@lang('profile.phone_number')</label>
                            <input id="phone" type="text"
                                   data-rule-required="true"
                                   value="{{ $user->phone_number }}"
                                   class="form-control">
                            <input id="phoneNumber" type="hidden" name="phoneNumber">
                            @if ($errors->has('phoneNumber'))
                                <span class="text-danger">
                        <strong>{{ $errors->first('phoneNumber') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="countryCode">@lang('profile.country')</label>
                            <select id="countryCode" type="text" name="countryCode"
                                    data-rule-required="true"
                                    class="form-control">
                                <option value="">Select Option</option>
                            </select>
                            @if ($errors->has('countryCode'))
                                <span class="text-danger">
                        <strong>{{ $errors->first('countryCode') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="timezone">@lang('profile.timezone')</label>
                            <select id="timezone" type="text" name="timezone"
                                    data-rule-required="true"
                                    class="form-control">
                                <option value="">Select Option</option>
                                @foreach($timezones as $timezone)
                                    <option value="{{ $timezone }}"
                                            {{ $timezone == $user->timezone ? "selected":"" }}>
                                        {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('timezone'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('timezone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-simple"
                                data-dismiss="modal"> @lang('profile.close')
                        </button>
                        <button type="submit" class="btn btn-primary btn-round">
                            @lang('profile.submit')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
