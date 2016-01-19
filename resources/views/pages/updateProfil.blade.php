@extends('layout')
@section('title', $title)
@section('content')

	<h2 class="pageTitle">{{ $title }}</h2>
	<div class="spaceContainer">
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
				<input type="password" class="form-control" name="password" id="password" >
			</div>
			
			<div class="form-group">
				<label for="checkPassword">valider le nouveau mot de passe</label>
				<input type="password" class="form-control" name="checkPassword" id="checkPassword">
			</div>

			<div class="form-group">
				<a href="{{ action( 'PageController@about', [ 'id' => $id ] ) }}" class="btn btn-back">Annuler</a>
				<input type="submit" class="btn btn-send" value="Valider les modifications">
				<div class="clear"></div>
			</div>
		</form>
		@include('errors.profilError')
	</div>


@endsection