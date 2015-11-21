<!DOCTYPE html>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="datepicker-fr.js"></script>

	
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
	@if( Auth::check() )
	<div class="row col-sm-12" style="margin-top: 1em;">
		<nav class="col-sm-2">
			<ul class="nav nav-pills nav-stacked panel panel-default">
					@if( Auth::user()->status == 1 )
						<li class="active"><a href="#">ZONE PROF</a></li>
						<li><a href="{!! action( 'CoursesController@index' ) !!}">Mes cours</a></li>
						<li><a href="{!! action( 'PageController@about' ) !!}">Mes informations</a></li>
						<li><a href="{!! action( 'PageController@notification' ) !!}">Notifications</a></li>
						<li><a href="{!! action( 'PageController@message' ) !!}">Messages</a></li>
						<li><a href="{!! action( 'PageController@planning' ) !!}">Mon planning</a></li>
					@elseif( Auth::user()->status == 2 )
						<li class="active"><a href="#">ZONE ELEVE</a></li>
						<li><a href="{!! action( 'CoursesController@index' ) !!}">Mes cours</a></li>
						<li><a href="{!! action( 'PageController@about' ) !!}">Mes informations</a></li>
						<li><a href="{!! action( 'PageController@notification' ) !!}">Notifications</a></li>
						<li><a href="{!! action( 'PageController@message' ) !!}">Messages</a></li>
						<li><a href="{!! action( 'PageController@planning' ) !!}">Mon planning</a></li>
					@endif
				<li><a class="" href="{!! action( 'Auth\AuthController@getLogout' ) !!}">Se déconnecter</a></li>
				@endif()
			</ul>
			<br>
			<br>
			<br>
			@if( Auth::check() )
				@if( Auth::user()->status == 1 )
					<ul class=" list-group notification">
						<li class="list-group-item active">NOTIFICATIONS</li>
						<li class="list-group-item">
							<a href="">Loïc Parent</a>
							Demande l'accès au cours de Sciences (groupe SC2)
							<a href="" class="btn btn-success">Accepter</a>
							<a href="" class="btn btn-danger">Refuser</a>
						</li>
						<li class="list-group-item">
							<a href="">David Degrégoris</a>
							Demande l'accès au cours de Sciences (groupe SC2)
							<a href="" class="btn btn-success">Accepter</a>
							<a href="" class="btn btn-danger">Refuser</a>
						</li>
						<li class="list-group-item">
							Nouveau message de
							<a href="">David Degrégoris</a>
							<a href="{{ action( 'PageController@message' ) }}" class="btn btn-primary">Voir le message</a>
						</li>
					</ul>
				@elseif( Auth::user()->status == 2 )
					<ul class=" list-group notification">
						<li class="list-group-item active">NOTIFICATIONS</li>
						<li class="list-group-item">
							Nouveau devoir pour le 
							<a href="">cours de Math</a>
							<a href="" class="btn btn-success">plus d'info</a>
						</li>
						<li class="list-group-item">
							<a href="">M. Granjean</a>
							sera absent du pour les deux prochain cours
							<a href="" class="btn btn-success">Voir sur le planning</a>
						</li>
						<li class="list-group-item">
							Un changement de local est prévus pour le 
							<a href="">Cours de sciences</a>
							<a href="" class="btn btn-success">Voir la notification</a>
						</li>
					</ul>
				@endif
			@endif
		</nav>

		<div class="container col-sm-10">
			@yield('content')
		</div>
	</div>
</body>
</html>