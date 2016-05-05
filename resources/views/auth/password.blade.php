@extends('logoutLayout')
@section('title', 'Mot de passe oublié')
@section('content')
<!-- resources/views/auth/password.blade.php -->
<div class="blockTitle">
    <h2 class="mainTitle">Mot de passe oublié</h2>
</div>

<form method="POST" action="/password/email">
    {!! csrf_field() !!}

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <button type="submit">
            Envoyez un lien par email
        </button>
    </div>
</form>
@stop
