@extends('layouts.master')

@section('content')
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
         data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        @include('app.nav.top_nav')
        @include('app.nav.sidebar')
        <div class="page-wrapper">
            <div class="container-fluid">
                @if(Auth::user()->status == \App\Models\User::SUSPENDED)
                    <div class="alert alert-danger" role="alert">
                        <i class="ti ti-alert"></i> @lang('profile.suspended_message')
                    </div>
                @endif
                @if(is_null(Auth::user()->timezone))
                    <div class="alert alert-warning" role="alert">
                        <i class="ti ti-alert"></i>
                       @lang('profile.timezone_message')
                        <a class="btn btn-sm btn-primary" href="{{ route('profile')}}">
                            @lang('profile.view_profile')
                        </a>
                    </div>
                @endif
                @yield('app')
            </div>
        </div>
    </div>
@endsection
