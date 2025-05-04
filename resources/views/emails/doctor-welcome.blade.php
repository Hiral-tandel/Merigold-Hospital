@component('mail::message')
# Welcome to Our Hospital Team

Dear Dr. {{ $doctor->name }},

Welcome to our hospital! We're excited to have you join our medical team. Below are your login credentials:

**Email:** {{ $doctor->email }}
**Password:** {{ $password }}

Please change your password after your first login for security purposes.

@component('mail::button', ['url' => route('login')])
Login to Your Account
@endcomponent

If you have any questions or need assistance, please don't hesitate to contact the administration.

Best regards,<br>
{{ config('app.name') }}
@endcomponent 