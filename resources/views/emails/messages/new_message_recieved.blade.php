@component('mail::message')
# {{ __('emails.salutation',['name' => $message->recipient->name]) }},

{{ __('emails.messages.new.message',['sender' => $message->sender->userType->name == 'Employee' ?
    $message->sender->employeeProfile->department->name:$message->sender->userType->name ])  }}.

@component('mail::button', ['url' => route('messages.index')])
{{ __('emails.messages.new.cta') }}
@endcomponent

@lang('emails.regards')<br>
{{ config('app.name') }}
@endcomponent
