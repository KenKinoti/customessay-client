@extends('layouts.page')

@section('title','No permissions')

@section('page')
    <section class="py-7">
        <div class="container">
            <div class="text-center">
                <div class="error-title-block">
                    <i class="ti ti-broken"></i>
                    <h1 class="my-4">403</h1>
                    <h3 class="text-black-50">@lang('errors.403.heading')</h3>
                    <p>@lang('errors.403.message')</p>
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
