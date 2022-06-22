@extends('layouts.app')

@section('title','Notifications')

@section('app')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h4 class="my-3">
                <i class="ti ti-bell-o"></i> @lang('notification.title')
            </h4>
            <div class="card">
                <div class="card-body">
                    <div class="notifications">
                        @forelse($notifications as $notification)
                            <div class="notification{{ $notification->read_at ? "":" unread" }}">
                                <a href="{{ $notification->data['url'].'?notification='.$notification->id }}">
                                    <p>{{ $notification->data['message'] }}</p>
                                    <small class="time">{{ $notification->formattedDateTime('created_at') }}</small>
                                </a>
                            </div>
                        @empty
                            <div class="alert alert-info mb-0">
                                <i class="ti ti-info-circle"></i>
                                @lang('notification.no_notifications')
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="margin-top-10">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
@endsection
