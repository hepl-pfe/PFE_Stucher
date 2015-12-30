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

	<h1>{{$title}}</h1>
	<a class="btn btn-warning" href="{!! action( 'CourseController@index' ) !!}"><—</a>
	@if( Auth::user()->status == 1 )
		<a class="btn btn-warning" href="{!! action( 'CourseController@edit', [ 'id' => $course->id] ) !!}">Modifier ce cours</a>
		<!-- Modal -->
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal1">Supprimer ce cours</button>
		<div id="myModal1" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Voulez-vous vraiment supprimer ce cours?</h4>
					</div>
					<div class="modal-body">
						<p>Attention, c'est irréversible!</p>
						<p>En supprimant ce cours, vous supprimerez toutes les séances ainsi que tous les devoirs et interrogations s'y rapportant</p>
					</div>
					<div class="modal-footer">
						<a href="{!! action( 'CourseController@delete', [ 'id' => $course->id] ) !!}" class="btn btn-danger">Oui</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
					</div>
				</div>
			</div>
		</div>
		<span class="btn btn-success" >Code d'accès au cours: {{ $course->access_token }}</span>
		<!-- Dropdown menu -->
		<div class="dropdown" style="display: inline-block;">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">+
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
				<li><a href="{!! action( 'WorkController@create', ['id' => $course->id, 'info' => 'course'] ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'TestController@create', ['id' => $course->id, 'info' => 'course'] ) !!}">Une interrogation</a></li>
				<li><a href="{!! action( 'CourseController@addNews' ) !!}">Une notification</a></li>
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
		      		<div class="panel-heading">Les séances de cours</div>
		      		<ul class="panel-body">
		      		@if ( isset($seances) )
		      			@if ( count($seances) == 0 )
			      			<p>Il n’y a aucune séance pour le moment</p>
			      			@if (\Auth::user()->status == 1)
			      				<a class="btn btn-primary" href="{!! action( 'SeanceController@create', ['id' => $id] ) !!}">Créer des séances de cours	
			      			@endif
			      			</a>
			      		@else
				      		@foreach( $seances as $seance )
				      			<a href="{!! action( 'SeanceController@view', ['id' => $seance->id] ) !!}" class="btn btn-success">{{ $seance->start_hours->formatLocalized('%A %d %B %Y') }} de {{ $seance->start_hours->formatLocalized('%Hh%M') }} à {{ $seance->end_hours->formatLocalized('%Hh%M') }}</a>
				      			@if ( Auth::user()->status == 1 )
				      				<a class="btn btn-warning" href="{!! action( 'SeanceController@edit', [ "id" => $seance->id ] ) !!}">Modifier</a>
								<!-- Modal -->
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $seance->id }}">X</button>
								<div id="{{ $seance->id }}" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Voulez-vous vraiment supprimer cette séance?</h4>
											</div>
											<div class="modal-body">
												<p>Attention, c'est irréversible!</p>
												<p>En supprimant cette séance, vous supprimerez tous les devoirs et interrogations s'y rapportant.</p>
											</div>
											<div class="modal-footer">
												<a href="{!! action( 'SeanceController@delete', [ "id" => $seance->id, "course_id" => $seance->course_id ] ) !!}" class="btn btn-danger">Oui</a>
												<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
											</div>
										</div>
									</div>
								</div>
				      			@endif
				      			<br><br>
				      		@endforeach
				      		
				      		@if ( \Auth::user()->status == 1 )
					      		<!-- Modal -->
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal3">Supprimer Toutes les séances</button><br><br>
								<div id="myModal3" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Voulez-vous vraiment supprimer toutes les séances?</h4>
											</div>
											<div class="modal-body">
												<p>Attention, c'est irréversible!</p>
											</div>
											<div class="modal-footer">
												<a href="{!! action( 'SeanceController@deleteAll', [ 'course' => $course->id] ) !!}" class="btn btn-danger">Oui</a>
												<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
											</div>
										</div>
									</div>
								</div>
							@endif
			      		@endif
		      		@else
		      			<p>Il n’y a aucune séance pour le moment</p>
		      		@endif
		      		</ul>
		    	</div>
		    	<div class="panel-warning">
		      		<div class="panel-heading">Journal du cours</div>
		      		<ul class="panel-body">
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
		      		<div class="panel-heading">Élèves qui suivent le cours</div>
		      		@if ( count($inCourseStudents) !== 0 )
			      		<ul class="panel-body">
			      			@foreach( $inCourseStudents as $student )
		      					<li><a href="">{{ $student->name }}</a>
								<!-- Modal -->
								<button type="button" class="btn badge btn-danger pull-right" data-toggle="modal" data-target="#myModal4">Retirer de ce cours</button>
								<div id="myModal4" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Voulez-vous vraiment retirer {{ $student->name }} de ce cours?</h4>
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
		    	</div>
		    	<div class="panel-danger">
		      		<div class="panel-heading">Élèves qui demande à suivre le cours</div>
		      		<div class="panel-body">
		      		@if ( count($demandedStudents) !== 0 )
			      		@foreach ($demandedStudents as $student)
			      			<li><a href="">{{$student->name}}</a><a class="btn btn-success pull-right" href="{!! action( 'CourseController@acceptStudent', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}">Ajouter</a> <a class="btn btn-danger pull-right" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}">Refuser l’accès</a></li><br>
			      		@endforeach
		      		@else
	      				<p>Il n’y a aucun étudiant pour le moment</p>
	      			@endif
		      		</div>
		    	</div>
		    	@endif()
			</div>
		</div>
	@endif()
@stop