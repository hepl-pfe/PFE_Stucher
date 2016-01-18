<?php use Carbon\Carbon; ?>


@extends( 'layout' )
    @section( 'content' )
    @section( 'title', $title )
	<h1>Séance de cours</h1>
	<a class="btn btn-warning" href="{!! action( 'CourseController@view', [ "id" => $seance->course_id, "action" => 1 ] ) !!}"><—</a>
	
	@if ( \Auth::user()->status == 1 )
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
						<p>En supprimant cette séance, vous supprimerez tous les devoirs et interrogations s'y rapportant.</p>
					</div>
					<div class="modal-footer">
						<a href="{!! action( 'SeanceController@delete', [ "id" => $seance->id, "course_id" => $seance->course_id ] ) !!}" class="btn btn-danger">Oui</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Dropdown menu -->
		<div class="dropdown" style="display: inline-block;">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">+
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'WorkController@create', ['id' => $seance->id, 'info' => 'seance'] ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'TestController@create', ['id' => $seance->id, 'info' => 'seance'] ) !!}">Une interrogation</a></li>
			</ul>
		</div>
	@endif
	
	<br><br>
	<div class="panel-group">
		<div class="row">
			<div class="panel-primary">
	      		<div class="panel-heading">Informations sur la séances:</div>
	      		<div class="panel-body">
	      			<p><span>Jour : </span>{{ $seance->start_hours->formatLocalized('%A %d %B %Y') }}</p>
	      			<p><span>Heure : </span>de {{ $seance->start_hours->formatLocalized('%Hh%M') }} à {{ $seance->end_hours->formatLocalized('%Hh%M') }}</p>
	      		</div>
	      	</div>
	      	@if ( isset($tests) )
			    @if ( count($tests) == 0 )
				@else
			      	<div class="panel-warning">
			      		<div class="panel-heading">Interrogation:</div>
			      		<ul class="panel-body list-group">
							@foreach ($tests as $test)
								<li class="list-group-item">
									<h3>{{$test->title}}

									@if ( \Auth::user()->status == 1 )
										<!-- Modal -->
										<button type="button" class="btn badge btn-danger pull-right" data-toggle="modal" data-target="#myTest{{ $test->id }}">Supprimer</button>
										<div id="myTest{{ $test->id }}" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Voulez-vous vraiment supprimer cette interrogation?</h4>
													</div>
													<div class="modal-body">
														<p>Attention, c'est irréversible!</p>
													</div>
													<div class="modal-footer">
														<a href="{!! action( 'TestController@delete', ['id' => $test->id] ) !!}" class="btn btn-danger">Oui</a>
														<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
													</div>
												</div>
											</div>
										</div>

										<a href="{{ action( 'TestController@edit', ['id' => $test->id] ) }}" class="btn badge btn-warning pull-right">modifier</a>
									@endif

									 </h3>
									<p>
										{{$test->description}}
									</p>

								</li>
							@endforeach
			      		</ul>
			      	</div>
		      	@endif
		    @endif
		    @if ( isset($works) )
			    @if ( count($works) == 0 )
				@else
			      	<div class="panel-warning">
			      		<div class="panel-heading">Devoirs:</div>
			      		<ul class="panel-body list-group">
							@foreach ($works as $work)
								<li class="list-group-item">
									<h3>{{$work->title}}

									@if ( \Auth::user()->status == 1 ) 
										<!-- Modal -->
										<button type="button" class="btn badge btn-danger pull-right" data-toggle="modal" data-target="#myWork{{ $work->id }}">Supprimer</button>
										<div id="myWork{{ $work->id }}" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Voulez-vous vraiment supprimer ce devoir?</h4>
													</div>
													<div class="modal-body">
														<p>Attention, c'est irréversible!</p>
													</div>
													<div class="modal-footer">
														<a href="{!! action( 'WorkController@delete', ['id' => $work->id] ) !!}" class="btn btn-danger">Oui</a>
														<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
													</div>
												</div>
											</div>
										</div>

										<a href="{{ action( 'WorkController@edit', ['id' => $work->id] ) }}" class="btn badge btn-warning pull-right">modifier</a>
									@endif
									
									</h3>

									<p>
										{{$work->description}}
									</p>
								</li>
							@endforeach
			      		</ul>
			      	</div>
			    @endif
			@endif
      	</div>
    </div>
@stop