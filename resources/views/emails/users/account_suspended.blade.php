@component('mail::message')
# {{ __('emails.salutation',['name' => $user->name]) }},

@lang('emails.users.suspended.message.p1')

@lang('emails.users.suspended.message.p2')

@lang('emails.users.suspended.message.p3')

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
