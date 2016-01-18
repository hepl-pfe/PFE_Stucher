@extends( 'layout' )
@section( 'content' )
@section( 'title', $title )

<h1>{{$title}}</h1>

@if ( count($inCourseStudents) !== 0 )
	<ul class="panel-body">
		@foreach( $inCourseStudents as $student )
			<li><a href="{{ action( 'PageController@viewUser', [ 'id' => $student->id ] ) }}">{{ $student->firstname }} {{ $student->name }}</a>
		<!-- Modal -->
		<button type="button" class="btn badge btn-danger pull-right" data-toggle="modal" data-target="#myModal4">Retirer de ce cours</button>
		<div id="myModal4" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Voulez-vous vraiment retirer {{ $student->firstname }} {{ $student->name }} de ce cours?</h4>
					</div>
					<div class="modal-footer">
						<a href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}" class="btn btn-danger">Oui</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</ul>
@else
	<p>Il n’y a aucun étudiant pour le moment</p>
@endif

@stop