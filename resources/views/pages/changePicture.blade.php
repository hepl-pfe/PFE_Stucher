@extends('layout')
@section('title', $title)
@section('content')

	<h2 class="mainTitle">{{ $title }}</h2>
	<div class="spaceContainer">
		<div class="image__container image__container--aboutPage block_center">
			<img src="{{ url() }}/img/profilPicture/{{ Auth::user()->image }}" alt="Image de profil">
		</div>
		<div class="clear"></div>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<label for="image">Changer l’image</label>
				<input type="file" class="form-control" name="image" id="image">
			</div>

			<div class="form-group text-center">
				<a href="{{ action( 'PageController@about' ) }}" class="btn btn-back">Annuler</a>
				<input type="submit" class="btn btn-send" value="Valider les modifications">
				<div class="clear"></div>
			</div>
		</form>

		@include('errors.profilError')
	</div>


@endsection