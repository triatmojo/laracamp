<x-mail::message>
# Your Transaction Has Been Confirmed

Hi, {{$checkout->user->name}}
<br>
Your transaction has been confirmed, now you can enjoy the benefits of <b>{{$checkout->Camp->title}}</b> camp.

@component('mail::button', ['url' => route('dashboard')])
    My Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
