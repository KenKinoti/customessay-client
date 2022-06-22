@extends('layouts.app')

@section('title','Messages')

@section('app')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="text-right my-2">
                <a href="#" class="btn btn-circled btn-success" data-toggle="modal" data-target="#new_message">
                    <i class="ti ti-plus"></i> @lang('message.new')
                </a>
            </div>
            <div class="card">
                @include('app.messages.messages')
            </div>
            {{ $messages->links() }}
        </div>
    </div>
    @include('app.messages.new_message')
    @include('app.messages.reply_message')
@endsection
