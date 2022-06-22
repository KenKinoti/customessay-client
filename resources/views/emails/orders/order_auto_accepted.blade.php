@component('mail::message')
# {{ __('emails.salutation',['name' => $order->client->name]) }},

@lang('emails.orders.accepted.message', ['orderId' => $order->id])

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
