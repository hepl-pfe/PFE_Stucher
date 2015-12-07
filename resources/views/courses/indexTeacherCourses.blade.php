@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
		<div class="dropdown text-right">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ajouter
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
				<li><a href="{!! action( 'WorkController@create' ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'TestController@create' ) !!}">Une interrogation</a></li>
				<li><a href="{!! action( 'CourseController@addNews' ) !!}">Une notification</a></li>
			</ul>
		</div>


		<h2>Tous mes cours</h2>
		<ul class="list-group">
			@if ( $courses->count() == null )
				<li class="list-group-item well well-lg">Aucun cours pour le moment</li>
			@endif
			@foreach ($courses as $course)
				<li class="list-group-item well well-lg"><a href="{!! action( 'CourseController@view', [ 'id' => $course->id, 'action' => 1 ] ) !!}">{{ $course->title }} groupe {{ $course->group }}</a></li>
			@endforeach
	    	<li class="list-group-item well-lg"><a href="{!! action( 'CourseController@create' ) !!}">Créer un nouveau cours</a></li>
    	</ul>
@stop