@extends( 'layout' )
@section( 'content' )
@section( 'title', $title )

<div class="blockTitle">
	<h2 class="mainTitle">Les élèves du cours</h2>
</div>

<!-- dd_moreButton -->
@if( \Auth::user()->status == 1 )
	<div class="dd_moreButton">
		<input type="checkbox" id="dd_moreButton">
		<label for="dd_moreButton" class="dd_moreButton--button"><span></span><span></span></label>

		<ul class="dd_moreButton--content">
			<li><a href="{!! action( 'CourseController@create' ) !!}">Ajouter un cours</a></li>
		</ul>
	</div>
@endif

<div class="box--group">
	<div class="box box--shadow">
		@if ( count($inCourseStudents) !== 0 )
		<ul class="list__course_box--group">
			@foreach( $inCourseStudents as $student )
				<li class="groupList__type1">
					<a href="{{ action( 'PageController@viewUser', [ 'id' => $student->id ] ) }}">{{ $student->firstname }} {{ $student->name }}</a>
					@if( \Auth::user()->status == 1 )
					<a class="seance__item--button delete" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}">Retirer de ce cours</a>
					@endif
				</li>
			@endforeach
		</ul>
		@else
			<p class="center">Il n’y a aucun étudiant pour le moment</p>
		@endif
	</div>
</div>

@stop