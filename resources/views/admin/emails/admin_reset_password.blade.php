@component('mail::message')
# Reset password
Welcom {{ $data['data']->name }} <br>
The body of your message.

@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
Click here to reset your password
@endcomponent

<br>
Or copy this link
{{ aurl('reset/password/'.$data['token']) }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
