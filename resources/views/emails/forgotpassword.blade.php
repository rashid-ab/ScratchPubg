@component('mail::message')
 # Hi {{ $content['name'] }}

Your new password: {{ $content['password'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
