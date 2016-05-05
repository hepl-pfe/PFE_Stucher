@extends('layout')
@section('title', $title)
@section('content')

	<div class="blockTitle">
		<h2 class="mainTitle">{{ $title }}</h2>
	</div>
	
	@if (empty($pastSeances))
		<p>Aucune séances pour le moment</p>
	@endif
	<ul class="list-group">
		@foreach ( $pastSeances as $seance )
		<li class="list-group-item">
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
		</li>
		@endforeach
	</ul>

@endsection