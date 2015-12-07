@extends('layout')
@section('title', $title)
@section('content')
	<h2 class="text-center">Mes informations&nbsp;:</h2>
	<h3 class="text-center">Nom: {{ Auth::user()->name }}</h3>
	<p class="text-center">Email: {{ Auth::user()->email }}</p>
	<div class="text-center">
		@if( Auth::user()->status == 1 )
			<a href="{{ action( 'CourseController@index' ) }}" class="btn btn-primary">Nombre de cours: <br><span>{{ $nbCourses }}</span></a>
			<a href="" class="btn btn-primary">Nombre d'élève: <br><span>{{ $nbUsers }}</span></a>
		@elseif( Auth::user()->status == 2 )
			<a href="{{ action( 'CourseController@index' ) }}" class="btn btn-primary">Nombre de cours: <br><span>1</span></a>
		@endif
		<br>
		<br>
		<br>
		<a href="{!! action( 'PageController@editProfil' ) !!}" class="btn btn-warning">Modifier mon profil</a>
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal1">Supprimer mon profil</button>
		<!-- Modal -->
		<div id="myModal1" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Voulez-vous vraiment supprimer votre compte?</h4>
					</div>
					<div class="modal-body">
						<p>Attention, c'est irréversible!</p>
					</div>
					<div class="modal-footer">
						<a href="{!! action( 'PageController@deleteProfil' ) !!}" class="btn btn-danger">Oui</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection