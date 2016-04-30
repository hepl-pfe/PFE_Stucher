<!-- resources/views/emails/password.blade.php -->
Hello, {{$user->username}}
Click here to reset your password: {{ url('password/reset/'.$token) }}