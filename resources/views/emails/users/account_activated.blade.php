@component('mail::message')
# {{ __('emails.salutation',['name' => $user->name]) }},

@lang('emails.users.activated.message.p1')

@lang('emails.users.activated.message.p2')

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
