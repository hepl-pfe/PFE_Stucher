@extends( 'layout' )
@section( 'content' )
@section( 'title', $title )

<h1>{{$title}}</h1>

@if ( count($students) !== 0 )
	<ul class="panel-body">
		@foreach( $students as $student )
			<li><a href="{{ action( 'PageController@viewUser', [ 'id' => $student[0]->id ] ) }}">{{ $student[0]->firstname }} {{ $student[0]->name }}</a>
		@endforeach
	</ul>
@else
	<p>Il n’y a aucun étudiant pour le moment</p>
@endif

@stop