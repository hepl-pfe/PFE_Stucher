<!DOCTYPE html>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>

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
	{{-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> --}}
	<!-- jQuery library -->
	<script src="{{ url() }}/js/jquery.js"></script>

	<!-- jQuery-ui library -->
	<script src="{{ url() }}/js/jquery-ui.js"></script>
	<link rel="stylesheet" href="{{ url() }}/css/jquery-ui.css">
	<link rel="stylesheet" href="{{ url() }}/css/jquery-ui.structure.css">
	<link rel="stylesheet" href="{{ url() }}/css/jquery-ui.theme.css">

	<!-- Calendar script and style -->
	{{-- <link href="{{ url() }}/css/fullcalendar.min.css" rel="stylesheet" />
	<link href="{{ url() }}/css/fullcalendar.print.css" rel="stylesheet" media="print" /> --}}
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
<body>
<div class="header--top">
	<div class="dropdown text-right">
		{{-- <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">+ --}}
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
			<li><a href="{!! action( 'WorkController@create', ['id' => 'null', 'info' => 'null'] ) !!}">Un devoir</a></li>
			<li><a href="{!! action( 'TestController@create', ['id' => 'null', 'info' => 'null'] ) !!}">Une interrogation</a></li>
			{{-- <li><a href="{!! action( 'CourseController@addNews' ) !!}">Une notification</a></li> --}}
		</ul>
	</div>
</div>
@if( Auth::check() )
	<div class="header--left">
		<a href="{!! action( 'CourseController@index' ) !!}"><h1 class="mainLogo">logo Stucher</h1></a>
		<nav class="mainNav">
			<h2 class="hidden">Menu principale</h2>
			<ul class="mainNav__ul">
					@if( Auth::user()->status == 1 )
						<li><a href="{!! action( 'CourseController@index' ) !!}">Mes cours</a></li>
						<li><a href="{!! action( 'PageController@about' ) !!}">Mes informations</a></li>
						<li><a href="{!! action( 'NotificationController@index' ) !!}">Notifications</a></li>
						{{-- <li><a href="{!! action( 'PageController@message' ) !!}">Messages</a></li> --}}
						<li><a href="{!! action( 'CalendarController@view' ) !!}">Mon planning</a></li>
					@elseif( Auth::user()->status == 2 )
						<li><a href="{!! action( 'CourseController@index' ) !!}">Mes cours</a></li>
						<li><a href="{!! action( 'PageController@about' ) !!}">Mes informations</a></li>
						<li><a href="{!! action( 'NotificationController@index' ) !!}">Notifications</a></li>
						{{-- <li><a href="{!! action( 'PageController@message' ) !!}">Messages</a></li> --}}
						<li><a href="{!! action( 'CalendarController@view' ) !!}">Mon planning</a></li>
					@endif
				<li><a class="" href="{!! action( 'Auth\AuthController@getLogout' ) !!}">Se déconnecter</a></li>
				@endif()
			</ul>
		</nav>
		@if( Auth::check() )
			<div class="notification__group--side">
				<h2 class="notification__title">NOTIFICATIONS</h2>
				<ul class="notification__group--side--list">
					@if ( count($notifications) != 'null' )
						@foreach ($notifications as $not)
							@if ($not->not_context == 1)	
				
							@endif

							@if ($not->not_context == 2)
								
							@endif

							@if ($not->not_context == 3)
								
							@endif

							@if ($not->not_context == 4)
								
							@endif

							@if ($not->not_context == 5)
								<li class="notification__group--item">
									<a href="{{ action('PageController@viewUser', [ 'id' => $not->user_id]) }}">{{$not->user_name}}</a> {{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
									@if ($not->not_seen != 3)
										<a class="btn btn-success pull-right" href="{!! action( 'CourseController@acceptStudent', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}">Ajouter</a> <a class="btn btn-danger pull-right" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}">Refuser</a>
									@endif
								</li>
							@endif

							@if ($not->not_context == 6)
								<li class="notification__group--item">
									{{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
								</li>
							@endif

							@if ($not->not_context == 7)
								<li class="notification__group--item">
									{{$not->not_title}} {{$not->course_title}}
								</li>
							@endif

							@if ($not->not_context == 8)
								<li class="notification__group--item">
									<a href="{{ action('PageController@viewUser', [ 'id' => $not->user_id]) }}">{{$not->user_name}}</a> {{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
								</li>
							@endif
						@endforeach
					@else
						<li class="notification__group--item--null">
							Aucune notification pour le moment
						</li>
					@endif
					<li class="notification__group--item--button"><a href="{!! action( 'NotificationController@index' ) !!}">Afficher toutes les news</a></li>
				</ul>
			</div>
		@endif
	</div>

	<div class="container">
		@yield('content')
	</div>
</body>
</html>