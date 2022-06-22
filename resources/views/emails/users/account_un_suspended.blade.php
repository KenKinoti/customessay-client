@component('mail::message')
# {{ __('emails.salutation',['name' => $user->name]) }},

@lang('emails.users.unsuspended.message.p1')

@lang('emails.users.unsuspended.message.p2')

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
