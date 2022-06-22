@component('mail::message')
# {{ __('emails.salutation',['name' => $order->client->name]) }},

@lang('emails.orders.submitted.message.p1', ['orderId' => $order->id])

@lang('emails.orders.submitted.message.p2')

@lang('emails.orders.submitted.message.p3')

@component('mail::button', ['url' => $url])
    @lang('emails.orders.submitted.cta')
@endcomponent.

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
