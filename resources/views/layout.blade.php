<!DOCTYPE html>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
<body>
	<div class="header">
		<div class="dropdown text-right">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">+
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
				<li><a href="{!! action( 'WorkController@create' ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'TestController@create' ) !!}">Une interrogation</a></li>
				{{-- <li><a href="{!! action( 'CourseController@addNews' ) !!}">Une notification</a></li> --}}
			</ul>
		</div>
	</div>
	@if( Auth::check() )
	<div class="row col-sm-12" style="margin-top: 1em;">
		<nav class="col-sm-2">
			<ul class="nav nav-pills nav-stacked panel panel-default">
					@if( Auth::user()->status == 1 )
						<li class="active"><a href="#">ZONE PROF</a></li>
						<li><a href="{!! action( 'CourseController@index' ) !!}">Mes cours</a></li>
						<li><a href="{!! action( 'PageController@about' ) !!}">Mes informations</a></li>
						<li><a href="{!! action( 'NotificationController@index' ) !!}">Notifications</a></li>
						{{-- <li><a href="{!! action( 'PageController@message' ) !!}">Messages</a></li> --}}
						<li><a href="{!! action( 'CalendarController@view' ) !!}">Mon planning</a></li>
					@elseif( Auth::user()->status == 2 )
						<li class="active"><a href="#">ZONE ELEVE</a></li>
						<li><a href="{!! action( 'CourseController@index' ) !!}">Mes cours</a></li>
						<li><a href="{!! action( 'PageController@about' ) !!}">Mes informations</a></li>
						<li><a href="{!! action( 'NotificationController@index' ) !!}">Notifications</a></li>
						{{-- <li><a href="{!! action( 'PageController@message' ) !!}">Messages</a></li> --}}
						<li><a href="{!! action( 'CalendarController@view' ) !!}">Mon planning</a></li>
					@endif
				<li><a class="" href="{!! action( 'Auth\AuthController@getLogout' ) !!}">Se déconnecter</a></li>
				@endif()
			</ul>
			<br>
			<br>
			<br>
			@if( Auth::check() )
				<ul class=" list-group notification">
				@if( Auth::check() )
					<li class="list-group-item active">NOTIFICATIONS</li>
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
									<li class="list-group-item">
										{{$not->user_name}} {{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
										@if ($not->not_seen != 3)
											<a class="btn btn-success pull-right" href="{!! action( 'CourseController@acceptStudent', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}">Ajouter</a> <a class="btn btn-danger pull-right" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}">Refuser</a>
											<br>
											<br>
											<br>
										@endif
									</li>
								@endif

								@if ($not->not_context == 6)
									<li class="list-group-item">
										{{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
									</li>
								@endif

								@if ($not->not_context == 7)
									<li class="list-group-item">
										{{$not->not_title}} {{$not->course_title}}
									</li>
								@endif

								@if ($not->not_context == 8)
									<li class="list-group-item">
										{{$not->user_name}} {{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
									</li>
								@endif
							@endforeach
						@else
							<li class="list-group-item">
								Aucune notification pour le moment
							</li>
						@endif
				@endif
				<li class="list-group-item"><a href="{!! action( 'NotificationController@index' ) !!}">Afficher toutes les news</a></li>
				</ul>
			@endif
		</nav>

		<div class="container col-sm-10">
			@yield('content')
		</div>
	</div>
</body>
</html>