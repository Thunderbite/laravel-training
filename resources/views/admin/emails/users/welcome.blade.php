@component('mail::message')

# Welcome to: {{ config('app.name') }}

Hi {{ $user['name'] }},

You have just been added as a user to the administration section of {{ config('app.name') }}.

Please use these login details to login to the system:

@component('mail::panel')
Username: {{ $user['email'] }}<br />
Password: {{ $password }}<br />
Login url: {{ url('admin') }}
@endcomponent

@component('mail::button', ['url' => url('admin')])
You can login here
@endcomponent

Have a great day,<br>
{{ config('app.name') }}
@endcomponent