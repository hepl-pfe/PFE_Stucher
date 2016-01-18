<?php use App\User; ?>
@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
		<a class="btn btn-primary" href="{!! action( 'CourseController@searchCourse' ) !!}">Ajouter un cours</a>
		
		<h2>Tous mes cours</h2>
		@if ( $courses->count() == null )
			<li class="list-group-item well well-lg">Aucun cours pour le moment</li>
		@endif
		@foreach( $courses as $course )
			@if ( $course->pivot->access === 1 )
				<li class="list-group-item well-lg"><a href="">{{ $course->title }} <span class="pull-right">en attente de validation</span> <a class="btn btn-danger pull-right" href="{!! action( 'CourseController@removeCourse', [ 'id' => $course->id ] ) !!}">Annuler la demande</a></a></li>
			@elseif ( $course->pivot->access === 2 )
				<li class="list-group-item well well-lg"><a href="{!! action( 'CourseController@view', [ 'id' => $course->id, 'action' => 1 ] ) !!}">{{ $course->title }}</a></li>
			@endif
		@endforeach
@stop