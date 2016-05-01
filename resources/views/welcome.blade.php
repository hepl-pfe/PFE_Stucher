@extends('logoutLayout')
@section('title', $title)
@section('content')

<body class="home">
    <div class="home__form">
        <h1 class="home__title">Connectez-vous…</h1>

        <form class="home__formu" method="POST" action="/auth/login">
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
                <input type="checkbox" name="remember"> <span>Remember Me</span>
            </div>

            <div class="form-group">
                <button class="home__btn home__send" type="submit">Connexion</button>
            </div>
            @include( 'errors.profilError' )
        </form>
    	<br>
        <h1 class="home__title">Ou inscrivez-vous…</h1>
        <div class="home__btnPart">
            <a class="home__btn" href="{{ action( 'PageController@registerStudent' ) }}">Comme élève</a>
        </div>
        <div class="home__btnPart">
            <a class="home__btn" href="{{ action( 'PageController@registerTeacher' ) }}">Comme professeur</a>
        </div>
        <div class="clear"></div>
    </div>

@endsection
