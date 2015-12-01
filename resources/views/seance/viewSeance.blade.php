<?php use Carbon\Carbon; ?>


@extends( 'layout' )
    @section( 'content' )
    @section( 'title', $title )
	<h1>{{$title}}</h1>
	<a class="btn btn-warning" href="{!! action( 'CourseController@view', [ "id" => $seance->course_id, "action" => 1 ] ) !!}"><—</a>
	<a class="btn btn-primary" href="{!! action( 'SeanceController@edit', [ "id" => $seance->id ] ) !!}">Modifier la séance</a>
	<!-- Modal -->
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal1">Supprimer cette séance</button>
		<div id="myModal1" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Voulez-vous vraiment supprimer cette séance?</h4>
					</div>
					<div class="modal-body">
						<p>Attention, c'est irréversible!</p>
					</div>
					<div class="modal-footer">
						<a href="{!! action( 'SeanceController@delete', [ "id" => $seance->id, "course_id" => $seance->course_id ] ) !!}" class="btn btn-danger">Oui</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
					</div>
				</div>
			</div>
		</div>
@stop