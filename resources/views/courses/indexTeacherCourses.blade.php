@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
		<div class="dropdown text-right">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ajouter
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
				<li><a href="{!! action( 'CourseController@addWork' ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'CourseController@addTest' ) !!}">Une interrogation</a></li>
				<li><a href="{!! action( 'CourseController@addNews' ) !!}">Une notification</a></li>
			</ul>
		</div>


		<h2>Tous mes cours</h2>
		<ul class="list-group">
			@foreach ($courses as $course)
				<li class="list-group-item well well-lg"><a href="{{ action( 'CourseController@view', [ 'id' => $course->id, 'action' => 1 ] ) }}">{{ $course->title }}</a></li>
			@endforeach
	    	<li class="list-group-item well-lg"><a href="{!! action( 'CourseController@create' ) !!}">Créer un nouveau cours</a></li>
    	</ul>
@stop