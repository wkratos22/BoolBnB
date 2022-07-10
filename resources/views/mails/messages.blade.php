@component('mail::message')

Email: {{ $messages['email']}}

Messaggio: {{ $messages['message']}}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
