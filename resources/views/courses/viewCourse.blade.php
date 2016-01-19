<?php 	use Carbon\Carbon;
		$the_user = 'not';

		if (in_array(\Auth::user()->id, $inCourseStudentsId)) {
			$the_user = 'valided';
		}
		elseif (in_array(\Auth::user()->id, $demandedStudentsId)) {
			$the_user = 'demanded';
		}
?>


@extends( 'layout' )
    @section( 'content' )
    @section( 'title', $title )

	<h1 class="pageTitle">{{$title}}</h1>
	<div class="spaceContainer">

		@if( Auth::user()->status == 1 )
			<span class="accessToken">Code d'accès au cours: <em title="Ce code permet à vos étudiants de vous retrouver rapidement">{{ $course->access_token }}</em></span>

			<div class="course__editAction">
				<a class="btn btn-warning" href="{!! action( 'CourseController@edit', [ 'id' => $course->id] ) !!}">Modifier ce cours</a>
				<a class="btn btn-warning" href="{!! action( 'CourseController@delete', [ 'id' => $course->id] ) !!}">Supprimer ce cours</a>
			</div>
			
			<!-- Dropdown menu -->
			<div class="mainDropdown">
				<button class="btn-add" type="button" data-toggle="dropdown">
				<span class="caret">Ajouter</span></button>
				<ul class="mainDropdown-menu">
					<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
					<li><a href="{!! action( 'WorkController@create', ['id' => $course->id, 'info' => 'course'] ) !!}">Un devoir</a></li>
					<li><a href="{!! action( 'TestController@create', ['id' => $course->id, 'info' => 'course'] ) !!}">Une interrogation</a></li>
					<li><a href="{!! action( 'SeanceController@create', ['id' => $id] ) !!}">Des séances de cours</a></li>
				</ul>
			</div>

		@elseif( Auth::user()->status == 2 )
			@if ( $the_user == "valided" )
				<!-- Modal -->
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2">Quitter ce cours</button>
				<div id="myModal2" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Voulez-vous vraiment quitter ce cours?</h4>
							</div>
							<div class="modal-footer">
								<a href="{!! action( 'CourseController@removeCourse', [ 'id' => $course->id ] ) !!}" class="btn btn-danger">Oui</a>
								<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
							</div>
						</div>
					</div>
				</div>
			@else
				<h2>Groupe: <a href="">{{ $course->group }}</a></h2>
				<h2>Professeur: <a href="">{{ $teacher[0]->name }}</a></h2>
				<h2>École: <a href="">Collège Saint-Louis Waremme</a></h2>
				<a class="btn btn-warning" href="{!! action( 'CourseController@searchCourse' ) !!}">Retour</a>
				<a class="btn btn-success" href="{!! action( 'CourseController@addCourse', [ 'id' => $course->id ] ) !!}">Ajouter à mes cours</a>
			@endif
		@endif


		@if ( $the_user == "valided" || \Auth::user()->status == '1' )

			<div class="panel-group">
				<br>
				<div class="row">
					<div class="panel-primary">
			      		<h3 class="subTitle">Les séances de cours</h3>

			      		<ul class="seance__group--list">
			      		@if ( isset($seances) )
			      			@if ( count($seances) == 0 )
				      			<p class="center">Il n’y a aucune séance pour le moment</p>
					      			@if (\Auth::user()->status == 1)
					      				<a class="btn btn_addSeance" href="{!! action( 'SeanceController@create', ['id' => $id] ) !!}">Créer des séances de cours	</a>
					      			@endif
				      		@else
					      		@foreach( $seances as $seance )
					      			<li class="seance__item">
						      			<a href="{!! action( 'SeanceController@view', ['id' => $seance->id] ) !!}" class="the_seance">{{ $seance->start_hours->formatLocalized('%A %d %B %Y') }} de {{ $seance->start_hours->formatLocalized('%Hh%M') }} à {{ $seance->end_hours->formatLocalized('%Hh%M') }}</a>
						      			@if ( Auth::user()->status == 1 )
						      				<a class="seance__item--button delete" href="{!! action( 'SeanceController@delete', [ "id" => $seance->id, "course_id" => $seance->course_id ] ) !!}">Supprimer</a>
						      				<a class="seance__item--button update" href="{!! action( 'SeanceController@edit', [ "id" => $seance->id ] ) !!}">Modifier</a>
						      			@endif
					      			</li>
					      		@endforeach
					      		
					      		@if ( \Auth::user()->status == 1 )
					      			<a class="btn btn_addSeance" href="{!! action( 'SeanceController@deleteAll', [ 'course' => $course->id] ) !!}">Supprimer toutes les séances</a>
						      		
								@endif
				      		@endif
			      		@else
			      			<p class="center">Il n’y a aucune séance pour le moment</p>
			      		@endif
			      		</ul>
			    	</div>
			    	<div class="panel-warning">
			      		<h3 class="subTitle">Journal du cours</h3>
			      		<ul class="course__diary--list">
			      		@foreach ($seances as $seance)
			      			@foreach ($seance->works as $work)
			      				<li>Devoir : <a href="{{ action( 'SeanceController@view', ['id' => $seance->id] ) }}">{{ $work->title }}</a></li>
			      			@endforeach
			      			@foreach ($seance->tests as $test)
			      				<li>Interrogation : <a href="{{ action( 'SeanceController@view', ['id' => $seance->id] ) }}">{{ $test->title }}</a></li>
			      			@endforeach
				        @endforeach
			      		</ul>
			    	</div>
			    	@if( Auth::user()->status == 1 )
					<div class="panel-primary">
			      		<h3 class="subTitle">Élèves qui suivent le cours</h3>
			      		@if ( count($inCourseStudents) !== 0 )
				      		<ul class="panel-body">
				      			@foreach( $inCourseStudents as $student )
			      					<li class="groupList__type1">
			      					<a href="{{ action( 'PageController@viewUser', [ 'id' => $student->id ] ) }}">{{ $student->firstname }} {{ $student->name }}</a>
									<a class="seance__item--button delete" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}">Retirer de ce cours</a>
				      			@endforeach
				      		</ul>
			      		@else
			      			<p class="center">Il n’y a aucun étudiant pour le moment</p>
			      		@endif
			    	</div>
			    	<div class="panel-danger">
			      		<h3 class="subTitle">Élèves qui demande à suivre le cours</h3>
			      		<div class="panel-body">
			      		@if ( count($demandedStudents) !== 0 )
				      		@foreach ($demandedStudents as $student)
				      			<li class="groupList__type1">
				      			<a href="{{ action( 'PageController@viewUser', [ 'id' => $student->id ] ) }}">{{ $student->firstname }} {{$student->name}}</a> <a class="seance__item--button delete" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}">Refuser l’accès</a> <a class="seance__item--button update" href="{!! action( 'CourseController@acceptStudent', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}">Ajouter</a></li><br>
				      		@endforeach
			      		@else
		      				<p class="center">Il n’y a aucun étudiant pour le moment</p>
		      			@endif
		      			<a class="btn btn_addSeance" href="{!! action( 'CourseController@indexCourseUsers', [ 'id' => $course->id] ) !!}">Voir tous les élèves qui suivent le cours</a>
			      		</div>
			    	</div>
			    	@endif()
				</div>
			</div>
		@endif()

	</div>
@stop