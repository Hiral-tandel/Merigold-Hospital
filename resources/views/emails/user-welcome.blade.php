@component('mail::message')
# Welcome to Our Hospital

Dear {{ $user->name }},

Thank you for signing in to our hospital system. We are glad to have you with us.

If you have any questions or need assistance, feel free to contact us.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
