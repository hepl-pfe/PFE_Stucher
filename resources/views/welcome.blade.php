@extends( 'layout' )
    @section('title', 'Accueil')
    @section( 'content' )
    <h1>Connectez-vous…</h1>

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
	<br>
    <h1>Ou inscrivez-vous…</h1>
    <a class="btn btn-primary btn-lg" href="{{ action( 'PageController@registerStudent' ) }}">Comme élève</a>
    <a class="btn btn-primary btn-lg" href="{{ action( 'PageController@registerTeacher' ) }}">Comme professeur</a>

@stop