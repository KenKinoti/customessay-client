@component('mail::message')
# {{ __('emails.salutation',['name' => $user->name]) }},

@lang('emails.users.deactivated.message.p1')

@lang('emails.users.deactivated.message.p2')

@lang('emails.users.deactivated.message.p3')

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
