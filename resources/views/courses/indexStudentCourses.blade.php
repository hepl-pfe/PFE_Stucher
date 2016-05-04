<?php use App\User; ?>
@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )

		<div class="blockTitle">
			<h2 class="mainTitle">Tous mes cours</h2>
		</div>

		<div class="spaceContainer">
			@if ( $courses->count() == null )
				<p class="list__empty">Aucun cours pour le moment</p>
			@endif
			<ul>
				@foreach( $courses as $course )
					@if ( $course->pivot->access === 1 )
						<li class=""><a href="">{{ $course->title }} <span class="pull-right">en attente de validation</span> <a class="btn btn-danger pull-right" href="{!! action( 'CourseController@removeCourse', [ 'id' => $course->id ] ) !!}">Annuler la demande</a></a></li>
					@elseif ( $course->pivot->access === 2 )
						<li class="list__round"><a href="{!! action( 'CourseController@view', [ 'id' => $course->id ] ) !!}">Cours de {{ $course->title }}</a></li>
					@endif
				@endforeach
				<li class="list__round list__round--empty">
	    			<a href="{!! action( 'CourseController@searchCourse' ) !!}">Ajouter un cours</a>
	    		</li>
			</ul>
		</div>
@stop