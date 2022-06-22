@extends('layouts.page')

@section('title','Registration Complete')

@section('page')
    <div class="py-5">
        <div class="container">
            <div class="w-45 ml-auto mr-auto">
                <div class="brand text-center py-5">
                    <p class="text-primary">
                        <span><i class="ti ti-3x fa-check-circle"></i></span>
                    <h2 class="mt-3"> @lang('auth.confirm.congratulations')</h2>
                    <p>@lang('auth.confirm.successful_account_creation')</p>
                    <p>
                        @lang('auth.confirm.creation_message_1')
                        <strong>@lang('auth.confirm.creation_message_2')</strong> @lang('auth.confirm.creation_message_3')
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
