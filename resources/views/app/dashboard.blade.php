@extends('layouts.app')

@section('title','Dashboard')

@section('app')
    <div class="dashboard">
        <div class="my-3 metrics">
            <div class="card-group">
                <div class="card border-right">
                    <a href="{{ route('orders.pending') }}">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ number_format($pendingCount) }}</h2>
                                    </div>
                                    <h6 class="text-black-50 font-weight-normal mb-0 w-100 text-truncate">
                                        @lang('order.pending_orders')
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-black-50"><i class="ti ti-time"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card border-right">
                    <a href="{{ route('orders.assigned') }}">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ number_format($assignedCount) }}</h2>
                                    </div>
                                    <h6 class="text-black-50 font-weight-normal mb-0 w-100 text-truncate">
                                        @lang('order.orders_in_progress')
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-black-50"><i class="ti ti-write"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card border-right">
                    <a href="{{ route('orders.submitted') }}">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ number_format($submittedCount) }}</h2>
                                    <h6 class="text-black-50 font-weight-normal mb-0 w-100 text-truncate">
                                        @lang('order.submitted_orders')</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-black-50"><i class="ti ti-check"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a href="{{ route('wallet') }}">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                            class="set-doller">{{ currency() }}</sup>{{ number_format($walletBalance) }}
                                    </h2>
                                    <h6 class="text-black-50 font-weight-normal mb-0 w-100 text-truncate">
                                        @lang('wallet.wallet_balance')
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-black-50"><i class="ti ti-wallet"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h6 class="pl-3 my-3 text-black-50 text-uppercase">
                    <i class="ti ti-shopping-cart-full"></i> @lang('order.recent_orders')</h6>
                <div class="card h-md-100">
                    <div class="card-body h-md-100">
                        @if($latestOrders->count())
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered m-0">
                                    <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Topic</th>
                                        <th width="10%">@lang('order.status')</th>
                                        <th width="30%">@lang('order.deadline')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latestOrders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('orders.show',['id'=> $order->id]) }}">
                                                    {{ $order->id }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('orders.show',['id'=> $order->id]) }}">
                                                    {{ $order->topic }}
                                                </a>
                                            </td>
                                            <td>@include('app.orders.status')</td>
                                            <td>
                                                @include('app.partials.order.deadline')
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div
                                class="d-flex flex-column justify-content-center align-items-center text-black-50 h-100">
                                <i class="ti ti-info-alt text-lg"></i>
                                <p class="mt-3">@lang('order.no_orders')</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2 mt-md-0">
                <h6 class="pl-3 my-3 text-black-50 text-uppercase"><i class="ti ti-bell"></i> @lang('notification.title')</h6>
                <div class="card h-md-100">
                    <div class="card-body h-md-100">
                        @if($notifications->count())
                            <div class="notifications">
                                @foreach($notifications as $notification)
                                    <div class="notification{{ $notification->read_at ? "":" unread" }}">
                                        <a href="{{ $notification->data['url'].'?notification='.$notification->id }}">
                                            <p>{{ $notification->data['message'] }}</p>
                                            <small
                                                class="time">{{ $notification->formattedDateTime('created_at') }}</small>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div
                                class="d-flex flex-column justify-content-center align-items-center text-black-50 h-100">
                                <i class="ti ti-info-alt text-lg"></i>
                                <p class="mt-3">@lang('notification.no_notifications')</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
