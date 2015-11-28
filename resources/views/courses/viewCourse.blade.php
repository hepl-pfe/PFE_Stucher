<?php use Carbon\Carbon; ?>


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
					</div>
					<div class="modal-footer">
						<a href="{!! action( 'CourseController@delete', [ 'id' => $course->id] ) !!}" class="btn btn-danger">Oui</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
					</div>
				</div>
			</div>
		</div>
		<a class="btn btn-success" href="">Code d'accès au cours: {{ $course->access_token }}</a>
		<!-- Dropdown menu -->
		<div class="dropdown" style="display: inline-block;">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">+
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
				<li><a href="{!! action( 'CourseController@addWork' ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'CourseController@addTest' ) !!}">Une interrogation</a></li>
				<li><a href="{!! action( 'CourseController@addNews' ) !!}">Une notification</a></li>
				<li><a href="{!! action( 'SeanceController@create', ['id' => $id] ) !!}">Des séances de cours</a></li>
			</ul>
		</div>
	@elseif( Auth::user()->status == 2 )
		@if ( $act == 1 )
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

	@if ( $act == 1 )

		<div class="panel-group">
			<br>
			<div class="row">
				<div class="panel-primary">
		      		<div class="panel-heading">Les séances de cours</div>
		      		<ul class="panel-body">
		      		@if ( isset($seances) )
		      			@if ( count($seances) == 0 )
			      			<p>Il n’y a aucune séance pour le moment</p>
			      		@else
				      		@foreach( $seances as $seance )
				      			<a href="{!! action( 'SeanceController@view', ['id' => $seance->id] ) !!}" class="btn btn-success">{{ $seance->start_hours->formatLocalized('%A %d %B %Y') }} de {{ $seance->start_hours->formatLocalized('%Hh%M') }} à {{ $seance->end_hours->formatLocalized('%Hh%M') }}</a><br><br>
				      		@endforeach
			      		@endif
		      		@else
		      			<p>Il n’y a aucune séance pour le moment</p>
		      		@endif
		      		</ul>
		    	</div>
		    	<div class="panel-warning">
		      		<div class="panel-heading">Journal du cours</div>
		      		<ul class="panel-body">
		      			<li>Devoir: Faire …</li>
		      		</ul>
		    	</div>
				<div class="panel-danger">
		      		<div class="panel-heading">Actions rapide</div>
		      		<div class="panel-body">
		      			
		      		</div>
		    	</div>
		    	@if( Auth::user()->status == 1 )
				<div class="panel-primary">
		      		<div class="panel-heading">Élèves qui suivent le cours</div>
		      		<ul class="panel-body">
		      			@foreach( $students as $student )
		      			<li><a href="">{{ $student->name }}</a></li>
		      			@endforeach
		      		</ul>
		    	</div>
		    	<div class="panel-danger">
		      		<div class="panel-heading">Élèves qui demande à suivre le cours</div>
		      		<div class="panel-body">
		      			<li><a href="">Émillie Gérard</a> <a class="btn btn-primary" href="">Ajouter</a> <a class="btn btn-danger" href="">Refuser l’accès</a></li>
		      			<li><a href="">Kévin delois</a> <a class="btn btn-primary" href="">Ajouter</a> <a class="btn btn-danger" href="">Refuser l’accès</a></li>
		      		</div>
		    	</div>
		    	@endif()
			</div>
		</div>
	@endif()
@stop