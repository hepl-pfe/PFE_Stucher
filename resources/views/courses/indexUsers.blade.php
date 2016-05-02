@extends( 'layout' )
@section( 'content' )
@section( 'title', $title )

<h1 class="mainTitle">{{$title}}</h1>

<div class="spaceContainer">

	@if ( count($inCourseStudents) !== 0 )
		<ul class="panel-body">
			@foreach( $inCourseStudents as $student )
				<li class="groupList__type1">
  					<a href="{{ action( 'PageController@viewUser', [ 'id' => $student->id ] ) }}">{{ $student->firstname }} {{ $student->name }}</a>
					<a class="seance__item--button delete" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}">Retirer de ce cours</a>
				</li>
			@endforeach
		</ul>
	@else
		<p class="center">Il n’y a aucun étudiant pour le moment</p>
	@endif
</div>

@stop