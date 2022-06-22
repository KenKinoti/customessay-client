@extends('layouts.page')

@section('title','Page not found')

@section('page')
    <section class="py-7">
        <div class="container">
            <div class="text-center">
                <div class="error-title-block">
                    <i class="ti ti-broken"></i>
                    <h1 class="my-4">404</h1>
                    <h3 class="text-black-50">@lang('errors.404.heading')</h3>
                    <p>@lang('errors.404.message')</p>
                </div>
                <div class="mt-4">
                    <a class="btn btn-primary btn-circled" href="{{ url('/') }}">
                        <i class="ti ti-angle-left"></i> @lang('errors.return_home')
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
