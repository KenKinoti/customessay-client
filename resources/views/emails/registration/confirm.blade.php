@component('mail::message')
# {{ __('emails.salutation',['name' => $recipient->name]) }},

@lang('emails.registration.confirm.message.p1',['appName' =>  config('app.name') ])

@lang('emails.registration.confirm.message.p2')

@component('mail::button', ['url' => route('confirm',['code' => $recipient->validation_code])])
@lang('emails.registration.confirm.cta')
@endcomponent

@lang('emails.registration.confirm.message.p3')

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
