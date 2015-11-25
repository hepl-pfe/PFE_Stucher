@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
		<a class="btn btn-primary" href="{!! action( 'CourseController@add' ) !!}">Ajouter un cours</a>
		
		<h2>Tous mes cours</h2>
		<ul class="list-group">
	    	<li class="list-group-item well well-lg"><a href="{{ action( 'CourseController@view', [ 'id' => 1, 'action' => 1 ] ) }}">Cours de sciences</a></li>
    	</ul>
@stop