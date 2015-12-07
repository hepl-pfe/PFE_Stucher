<?php use App\User; ?>
@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
		<a class="btn btn-primary" href="{!! action( 'CourseController@searchCourse' ) !!}">Ajouter un cours</a>
		
		<h2>Tous mes cours</h2>
		<?php $courses = User::find(\Auth::user()->id)->courses ?>
		@if ( $courses->count() == null )
			<li class="list-group-item well well-lg">Aucun cours pour le moment</li>
		@endif
		@foreach( $courses as $course )
			<li class="list-group-item well well-lg"><a href="{!! action( 'CourseController@view', [ 'id' => $course->id, 'action' => 1 ] ) !!}">{{ $course->title }}</a></li>
		@endforeach
@stop