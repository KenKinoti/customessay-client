@component('mail::message')
# {{ __('emails.salutation',['name' => $user->name]) }},

@lang('emails.registration.welcome.message.p1',['appName' => config('app.name')])

@lang('emails.registration.welcome.message.p2')

@lang('emails.registration.welcome.message.p3')

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
