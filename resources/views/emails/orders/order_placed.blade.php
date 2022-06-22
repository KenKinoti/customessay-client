@component('mail::message')
# @lang('emails.salutation',['name' => $order->client->name]),

@lang('emails.orders.placed.message', ['orderId' => $order->id])

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
