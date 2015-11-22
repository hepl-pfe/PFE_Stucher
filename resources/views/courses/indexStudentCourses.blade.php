@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
		<a class="btn btn-primary" href="{!! action( 'CoursesController@add' ) !!}">Ajouter un cours</a>
		
		<h2>Tous mes cours</h2>
		<ul class="list-group">
	    	<li class="list-group-item well well-lg"><a href="{{ action( 'CoursesController@view', [ 'id' => 18, 'action' => 1 ] ) }}">Cours de nréerlandais</a></li>
    	</ul>
@stop