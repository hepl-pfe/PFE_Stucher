@include( 'header' )
<body class="{{ isset(Auth::user()->color) ? Auth::user()->color : '' }}">
	<div class="header">
		<input type="checkbox" id="menuToggle">
		<label for="menuToggle" class="menuToggle"><span></span><span></span><span></span></label>

		<a class="mainLogo--link" href="{!! action( 'CourseController@index' ) !!}"><h1 class="mainLogo--title">logo Stucher</h1></a>

		<nav class="mainNav">
			<h2 class="hidden">Menu principale</h2>
			<ul class="mainNav__ul">
					<li><a class="<?php if ( isset($activePage) && $activePage == 'profil' ) { echo 'active';} ?>" href="{!! action( 'PageController@about' ) !!}"><span class="icon-user unlink whiteText whiteText--icon"></span>{{ Auth::user()->firstname }} {{ Auth::user()->name }}</a></li>
					<li><a class="<?php if ( isset($activePage) && $activePage == 'course' ) { echo 'active';} ?>" href="{!! action( 'CourseController@index' ) !!}">
							@if( \Auth::user()->status == 1 )
							<span class="icon-briefcase unlink whiteText whiteText--icon"></span>
							@else
							<span class="icon-graduation unlink whiteText whiteText--icon"></span>
							@endif
							Mes cours</a>
					</li>
					<li><a class="<?php if ( isset($activePage) && $activePage == 'notification' ) { echo 'active';} ?>" href="{!! action( 'NotificationController@index' ) !!}"><span class="icon-bell unlink whiteText whiteText--icon"></span>Notifications
							<span class="notificationNumer--menu">
								@if ( count($notifications) != 'null' )
									({{ count($notifications) }})
								@endif
							</span></a></li>
					<!-- <li><a class="<?php //if ( isset($activePage) && $activePage == 'message' ) { echo 'active';} ?>"href="{!! action( 'PageController@message' ) !!}">Messages</a></li> -->
					<li><a class="<?php if ( isset($activePage) && $activePage == 'planning' ) { echo 'active';} ?>" href="{!! action( 'CalendarController@view' ) !!}"><span class="icon-calendar unlink whiteText whiteText--icon"></span>Mon planning</a></li>
					<li><a href="{!! action( 'Auth\AuthController@getLogout' ) !!}"><span class="icon-power unlink whiteText whiteText--icon"></span>Se déconnecter</a></li>
			</ul>
		</nav>

		<div class="notification__group__header">
			<h2 class="notification__title">NOTIFICATIONS</h2>
			<ul class="notification__group--box">
				@if ( count($notifications) != 'null' )
					<?php $nNotification = 0; ?>
					@foreach ($notifications as $not)
						@if( $nNotification < 3 )
							<li class="notification__item">
								@if ($not->not_context == 1)

								@endif

								@if ($not->not_context == 2)

								@endif

								@if ($not->not_context == 3)

								@endif

								@if ($not->not_context == 4)

								@endif

								@if ($not->not_context == 5)
									<div class="notification__content notification__color--green">
										<a href="{{ action('PageController@viewUser', [ 'id' => $not->user_id]) }}"> {{$not->user_firstname}} {{$not->user_name}}</a> Demande accès au cours de <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
									</div>
									@if ($not->not_seen != 3)
										<div class="notification__actionGroup double">
											<a class="notification__button icon unlink success" href="{!! action( 'CourseController@acceptStudent', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}"><span class="icon-check"></span><span class="hidden">Ajouter</span></a>

											<a class="notification__button icon unlink danger" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}"><span class="icon-close"></span><span class="hidden">Refuser</span></a>
										</div>
									@endif
								@endif

								@if ($not->not_context == 6)
									{{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
								@endif

								@if ($not->not_context == 7)
									{{$not->not_title}} {{$not->course_title}}
								@endif

								@if ($not->not_context == 8)
									<a href="{{ action('PageController@viewUser', [ 'id' => $not->user_id]) }}">{{$not->user_firstname}} {{$not->user_name}}</a> a quitté le cours de <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
								@endif
								<div class="clear"></div>
							</li>
							<?php $nNotification++; ?>
						@endif
					@endforeach
				@else
					<li class="notification__item--null">
						Aucune notification pour le moment
					</li>
				@endif
				<li class="notification__item--more"><a href="{!! action( 'NotificationController@index' ) !!}">Afficher toutes les news</a></li>
			</ul>
		</div>
	</div>

	<div class="pageContainer">
		@yield('content')
		<div class="clear"></div>
	</div>
@include( 'footer' )
