<?php 
use Carbon\Carbon; 
Carbon::setLocale('fr');
?>
@extends('layout')
@section('title', $title)
@section('content')
	<div class="blockTitle">
		<h2 class="mainTitle">Notifications</h2>
	</div>
	@if( Auth::check() )
		<ul class="notification__group__page">
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

					@if ($not->not_context == 5)	<!-- DEMANDE ACCÈS -->
						<li class="notification__item notification__color notification__color--green">
							<div class="notification__content">
								{{$not->user_name}} {{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
								<span class="notification__time"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</div>
							@if ($not->not_seen != 3)
								<div class="notification__actionGroup">
									<a class="notification__button icon unlink success" href="{!! action( 'CourseController@acceptStudent', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}"><span class="icon-check"></span><span class="hidden">Ajouter</span></a>

									<a class="notification__button icon unlink danger" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}"><span class="icon-close"></span><span class="hidden">Refuser</span></a>
								</div>
								<div class="clear"></div>
							@endif

						</li>
					@endif

					@if ($not->not_context == 6)	<!-- ACCÈS AUTORISÉ -->
						<li class="notification__item notification__color notification__color--green">
							<div class="notification__content">
								{{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>

								<span class="notification__time"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</div>
							<div class="clear"></div>
						</li>
					@endif

					@if ($not->not_context == 7)	<!-- VOUS N'AVEZ PLUS ACCÈS -->
						<li class="notification__item notification__color notification__color--red">
							<div class="notification__content">
								{{$not->not_title}} {{$not->course_title}}
								<span class="notification__time"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</div>
							<div class="clear"></div>
						</li>
					@endif

					@if ($not->not_context == 8)	<!-- À QUITÉ LE COURS -->
						<li class="notification__item notification__color notification__color--red">
							<div class="notification__content">
								{{$not->user_name}} {{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>

								<span class="notification__time"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</div>
							<div class="clear"></div>
						</li>
					@endif
				@endforeach
			{!! $notifications->render() !!}
		@else
			<li class="item--null">Aucune notification pour le moment</li>
		@endif
		</ul>
	@endif

@endsection