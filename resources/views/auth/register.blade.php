@extends('logoutLayout')
@section('title', $title)
@section('content')

    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                <!-- old()  => est une variable temporaire qui récupère (le temps d'une requete) les information SANS le mot de passe histoire d’éviter de devoir TOUT retapper. -->
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <div class="form-group">
            <p>Vous êtes…</p>
            <label for="teacher">Un professeur</label>
            <input class="form-control" type="radio" name="status" id="teacher" value="1"> 

            <label for="student">Un étudiant</label>
            <input class="form-control" type="radio" name="status" id="student" value="2">
        </div>

        <div class="form-group">
            <button class="btn btn-default" type="submit">Register</button>
        </div>
    </form>
@stop
