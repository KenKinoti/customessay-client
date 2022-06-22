@extends('layouts.page')

@section('title','No permissions')

@section('page')
    <section class="py-7">
        <div class="container">
            <div class="text-center">
                <div class="error-title-block">
                    <i class="ti ti-broken"></i>
                    <h1 class="my-4">403</h1>
                    <h3 class="text-black-50">@lang('errors.deactivated.heading')</h3>
                    <p>@lang('errors.deactivated.message')</p>
                </div>
                <div class="mt-4">
                    <a class="btn btn-primary  btn-circled" href="{{ route('contact') }}">
                        <i class="ti ti-angle-left"></i>
                        @lang('errors.contact')
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
