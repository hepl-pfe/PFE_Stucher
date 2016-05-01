@include( 'header' )
<body class="{{ isset(Auth::user()->color) ? Auth::user()->color : '' }}">
	<div class="header">
		<input type="checkbox" id="menuToggle">
		<label for="menuToggle" class="menuToggle"><span></span><span></span><span></span></label>

		<a class="mainLogo--link" href="{!! action( 'CourseController@index' ) !!}"><h1 class="mainLogo--title">logo Stucher</h1></a>

		<nav class="mainNav">
			<h2 class="hidden">Menu principale</h2>
			<ul class="mainNav__ul">
					<li><a class="<?php if ( isset($activePage) && $activePage == 'profil' ) { echo 'active';} ?>" href="{!! action( 'PageController@about' ) !!}">{{ Auth::user()->firstname }} {{ Auth::user()->name }}</a></li>
					<li><a class="<?php if ( isset($activePage) && $activePage == 'course' ) { echo 'active';} ?>" href="{!! action( 'CourseController@index' ) !!}">Mes cours</a></li>
					<li><a class="<?php if ( isset($activePage) && $activePage == 'notification' ) { echo 'active';} ?>" href="{!! action( 'NotificationController@index' ) !!}">Notifications</a></li>
					<!-- <li><a class="<?php //if ( isset($activePage) && $activePage == 'message' ) { echo 'active';} ?>"href="{!! action( 'PageController@message' ) !!}">Messages</a></li> -->
					<li><a class="<?php if ( isset($activePage) && $activePage == 'planning' ) { echo 'active';} ?>" href="{!! action( 'CalendarController@view' ) !!}">Mon planning</a></li>
					<li><a href="{!! action( 'Auth\AuthController@getLogout' ) !!}">Se déconnecter</a></li>
			</ul>
		</nav>

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
	</div>

	<div class="pageContainer">
		@yield('content')
		<div class="clear"></div>
	</div>
@include( 'footer' )
