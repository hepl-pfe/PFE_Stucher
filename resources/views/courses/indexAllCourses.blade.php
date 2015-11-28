@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
    <h2>Tous les cours existants</h2>
	<div class="list-group">
		@foreach ($courses as $course)
			<li class="list-group-item well well-lg"><a href="{!! action( 'CourseController@view', [ 'id' => $course->id, 'action' => 2 ] ) !!}">{{ $course->title }} ({{ $course->group }})</a></li>
		@endforeach
	</div>
@stop