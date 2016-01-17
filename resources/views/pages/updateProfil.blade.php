@extends('layout')
@section('title', $title)
@section('content')

	<h2>{{ $title }}</h2>
	<form action="" method="post">
		<div class="form-group">
			<label for="firstname">Votre prénom</label>
			<input type="text" class="form-control" name="firstname" id="firstname" placeholder="ex: Mathématiques" value="{{ $firstname }}">
		</div>
		
		<div class="form-group">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="name">Votre nom</label>
			<input type="text" class="form-control" name="name" id="name" placeholder="ex: Mathématiques" value="{{ $name }}">
		</div>

		<div class="form-group">
			<label for="email">Votre email</label>
			<input type="text" class="form-control" name="email" id="email" placeholder="ex: 3e gestion" value="{{ $email }}">
		</div>

		<div class="form-group">
			<label for="password">votre nouveau mot de passe</label>
			<input type="password" class="form-control" name="password" id="password" value="{{ $password }}">
		</div>
		
		<div class="form-group">
			<label for="checkPassword">valider le nouveau mot de passe</label>
			<input type="password" class="form-control" name="checkPassword" id="checkPassword" value="{{ $password }}">
		</div>

		<div class="form-group text-center">
			<input type="submit" class="btn btn-primary" value="Valider les modifications">
			<a href="{{ action( 'PageController@about', [ 'id' => $id ] ) }}" class="btn btn-warning">Annuler</a>
		</div>
	</form>

	@include('errors.profilError')


@endsection