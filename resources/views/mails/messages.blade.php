@component('mail::message')

Email: {{ $contact['email']}}

Messaggio: {{ $contact['message']}}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
