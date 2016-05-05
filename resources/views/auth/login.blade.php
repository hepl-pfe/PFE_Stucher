@extends('logoutLayout')
@section('title', 'Connexion - Stucher')
@section('content')

    <div class="blockTitle">
        <h2 class="mainTitle">Connexion</h2>
    </div>

    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <input type="checkbox" name="remember"> Remember Me
        </div>

        <div class="form-group">
            <button class="btn btn-default" type="submit">Login</button>
        </div>
        
    </form>
@stop
