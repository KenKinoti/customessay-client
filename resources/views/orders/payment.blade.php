@extends('layouts.page')

@section('title', __('order.page.edit.title'))

@section('page')
    <div class="py-5 bg-light">
        <div class="container">
            <div class="order">
                @include('orders.partials.error')
                <form id="orderForm" action="{{ route('orders.complete',['id' => $order->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-8 bg-white">
                            @include('orders.shared.form')
                        </div>
                        <div class="col-md-4">
                            @include('orders.shared.checkout')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
