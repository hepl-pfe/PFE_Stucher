@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
    <h2>Tous les cours existants</h2>
	<div class="list-group">
		<li class="list-group-item well well-lg"><a href="{{ action( 'CourseController@view', [ 'id' => 8, 'action' => 2 ] ) }}">Cours de nréerlandais (groupe: 3TQ)</a></li>
    	<li class="list-group-item well well-lg"><a href="">Cours de nréerlandais (groupe: 4TQ-2)</a></li>
    	<li class="list-group-item well well-lg"><a href="">Cours de français (groupe: 3TQ)</a></li>
	</div>
@stop