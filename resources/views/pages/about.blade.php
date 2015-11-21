@extends('layout')
@section('title', $title)
@section('content')
	<h2 class="text-center">Mes informations&nbsp;:</h2>
	<h3 class="text-center">Nom: {{ Auth::user()->name }}</h3>
	<p class="text-center">Email: {{ Auth::user()->email }}</p>
	<div class="text-center">
		<a href="{{ action( 'CoursesController@index' ) }}" class="btn btn-primary">Nombre de cours: <br><span>3</span></a>
		@if( Auth::user()->status == 1 )
			<a href="" class="btn btn-primary">Nombre d'élève: <br><span>15</span></a>
		@endif
		<br>
		<br>
		<br>
		<a href="" class="btn btn-warning">Modifier mon profil</a>
		<a href="" class="btn btn-danger">Supprimer mon profil</a>
	</div>
@endsection