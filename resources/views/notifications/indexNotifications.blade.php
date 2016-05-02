<?php 
use Carbon\Carbon; 
Carbon::setLocale('fr');
?>
@extends('layout')
@section('title', $title)
@section('content')
	<h2 class="mainTitle">Mes notifications&nbsp;:</h2>
	<div class="spaceContainer">
		@if( Auth::check() )
			{{-- <a class="btn btn-primary" style="margin: 1em;" href="{!! action( 'CourseController@addNews' ) !!}">Ajouter une notification</a>	 --}}

			@if ( count($notifications) != 'null' )
				<ul class="indexNotification">
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
							<li class="groupList__type1">
								{{$not->user_name}} {{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>
								@if ($not->not_seen != 3)
									<a class="btn-update" href="{!! action( 'CourseController@acceptStudent', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}">Ajouter</a> <a class="btn-delete" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $not->course_id, 'id_user' => $not->user_id] ) !!}">Refuser</a>
								@endif
								<span class="badge"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
								
							</li>
						@endif

						@if ($not->not_context == 6)
							<li class="groupList__type1">
								{{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>

								<span class="badge"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</li>
						@endif

						@if ($not->not_context == 7)
							<li class="groupList__type1">
								{{$not->not_title}} {{$not->course_title}} à été refusé

								<span class="badge"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</li>
						@endif

						@if ($not->not_context == 8)
							<li class="groupList__type1">
								{{$not->user_name}} {{$not->not_title}} <a href="{{ action('CourseController@view', [ 'id' => $not->course_id, 'action' => 1 ]) }}">{{$not->course_title}}</a>

								<span class="badge"><?= Carbon::createFromFormat('Y-m-d H:i:s', $not->not_created_at)->diffForHumans(); ?></span>
							</li>
						@endif
					@endforeach
				</ul>
				{!! $notifications->render() !!}
			@else
				<ul class="list-group">
					<li class="btn btn_addSeance">Aucune notification pour le moment</li>
				</ul>
			@endif
		@endif
	</div>

@endsection