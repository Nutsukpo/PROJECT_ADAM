<x-mail::message>
# Hello {($name)}
An account has been created for you with the password{($password)}

The body of your message.

<x-mail::button :url="'http://127.0.0.1:8000/login'">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
