@extends('layout')
@section('title', $title)
@section('content')

	<h2>{{ $title }}</h2>
	<img src="{{ url() }}/img/profilPicture/{{ Auth::user()->image }}" alt="Image de profil">
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="image">Changer l’image</label>
			<input type="file" class="form-control" name="image" id="image">
		</div>

		<div class="form-group text-center">
			<input type="submit" class="btn btn-primary" value="Valider les modifications">
			<a href="{{ action( 'PageController@about' ) }}" class="btn btn-warning">Annuler</a>
		</div>
	</form>

	@include('errors.profilError')


@endsection