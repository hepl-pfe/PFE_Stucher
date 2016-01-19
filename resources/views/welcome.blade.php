<!DOCTYPE html>
<html lang="fr-BE">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    {{-- Fav icon --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url() }}/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url() }}/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url() }}/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url() }}/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url() }}/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url() }}/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url() }}/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url() }}/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url() }}/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ url() }}/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url() }}/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url() }}/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url() }}/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="{{ url() }}/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    
    <!-- jQuery library -->
    <script src="{{ url() }}/js/jquery.js"></script>

    <!-- jQuery-ui library -->
    <script src="{{ url() }}/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="{{ url() }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ url() }}/css/jquery-ui.structure.css">
    <link rel="stylesheet" href="{{ url() }}/css/jquery-ui.theme.css">

    <!-- Calendar script and style -->
    <link href="{{ url() }}/css/fullcalendar.min.css" rel="stylesheet" />
    <link href="{{ url() }}/css/fullcalendar.print.css" rel="stylesheet" media="print" />
    <script src="{{ url() }}/js//moment.min.js"></script>
    <script src="{{ url() }}/js/fullcalendar.min.js"></script>
    <script src="{{ url() }}/js/fr.js"></script>

    <!-- My custom script -->
    <script src="{{ url() }}/js/main.js"></script>
    <!-- My custom style -->
    <link rel="stylesheet" href="{{ url() }}/css/main.css">
    <!-- My custom font -->
    <link href='https://fonts.googleapis.com/css?family=Asap:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    
    
    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
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
</body>
</html>