<x-mail::message>
# Register Camp: {{$checkout->camp->title}}

Hi, {{$checkout->user->name}}
<br>
Thank you for register on <b>{{$checkout->Camp->title}}</b>, please see payment instruction by click the button below.

@component('mail::button', ['url' => route('dashboard')])
    My Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
