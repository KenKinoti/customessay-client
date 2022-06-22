@component('mail::message')
# Hello,

{{ $message }}


*This email was sent from {{ config('app.name') }} contact us page*.
@endcomponent