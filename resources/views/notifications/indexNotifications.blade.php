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
					@if ($not->not_context == 1)	<!-- DEMANDE ACCÈS -->
						<li class="notification__item notification__color notification__color--green">
							<div class="notification__content">
								{{$not->user_firstname}} {{$not->user_name}} demande accès au cours de <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
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

					@if ($not->not_context == 2)	<!-- ACCÈS AUTORISÉ -->
						<li class="notification__item notification__color notification__color--green">
							<div class="notification__content">
								Vous avez accès au cours de <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>

								<span class="notification__time"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</div>
							<div class="clear"></div>
						</li>
					@endif

					@if ($not->not_context == 3)	<!-- ACCÈS REFUSÉ -->
						<li class="notification__item notification__color notification__color--red">
							<div class="notification__content">
								Votre demande d’accès au cours de  <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a> a été refusée

								<span class="notification__time"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</div>
							<div class="clear"></div>
						</li>
					@endif

					@if ($not->not_context == 4)	<!-- A QUITTÉ LE COURS -->
						<li class="notification__item notification__color notification__color--red">
							<div class="notification__content">
								{{$not->user_firstname}} {{$not->user_name}} a quitté le cours de <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>

								<span class="notification__time"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</div>
							<div class="clear"></div>
						</li>
					@endif

					@if ($not->not_context == 5)	<!-- VOUS N'AVEZ PLUS ACCÈS -->
						<li class="notification__item notification__color notification__color--red">
							<div class="notification__content">
								Vous n’avez plus accès au cours de {{$not->course_title}}
								<span class="notification__time"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</div>
							<div class="clear"></div>
						</li>
					@endif

					@if ($not->not_context == 6)	<!-- De nouvelles séances pour le cours -->

					@endif

					@if ($not->not_context == 7)	<!-- Séance suspendue pour cause d'absence -->

					@endif

					@if ($not->not_context == 8)	<!-- Séance supprimé -->

					@endif

					@if ($not->not_context == 9)	<!-- Nouveau Devoir -->

					@endif

					@if ($not->not_context == 10)	<!-- Nouveau Test -->

					@endif

					@if ($not->not_context == 11)	<!-- Devoir Modifié -->

					@endif

					@if ($not->not_context == 12)	<!-- Test Modifié -->

					@endif

					@if ($not->not_context == 13)	<!-- Devoir supprimé -->

					@endif

					@if ($not->not_context == 14)	<!-- Test supprimé -->

					@endif

					@if ($not->not_context == 15)	<!-- Cours Supprimé -->

					@endif

					@if ($not->not_context == 16)	<!-- Nouveau commentaire -->

					@endif


				@endforeach
			{!! $notifications->render() !!}
		@else
			<li class="item--null">Aucune notification pour le moment</li>
		@endif
		</ul>
	@endif

@endsection