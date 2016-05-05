@extends('layout')
@section('title', $title)
@section('content')
	<div class="blockTitle">
		<h2 class="mainTitle">Créer un nouveau cours</h2>
	</div>

	<div class="box--group">
		<div class="box box--shadow">
			<form class="box__group--content" action="" method="post">
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<label for="title">Ajouter le titre du cours</label>
					<input type="text" class="form-control" name="title" id="title" placeholder="ex: Mathématiques" value="{{ old('title') }}">
				</div>

				<div class="form-group">
					<label for="group">Ajouter le nom du groupe</label>
					<input type="text" class="form-control" name="group" id="group" placeholder="ex: 3e gestion" value="{{ old('group') }}">
				</div>

				<div class="form-group">
					<label for="school">Ajouter le nom de l'établissement scolaire</label>
					<input type="text" class="form-control" name="school" id="school" placeholder="ex: Saint-luc" value="{{ old('school') }}">
				</div>

				<div class="form-group">
					<label for="place">Ajouter le nom de la ville où se trouve cette école</label>
					<input type="text" class="form-control" name="place" id="place" placeholder="ex: Liège" value="{{ old('place') }}">
				</div>

				<div class="form-group text-center">
					<a class="btn btn-back" href="{!! action( 'CourseController@index' ) !!}">Annuler</a>
					<input type="submit" class="btn btn-send" value="Créer le cours">
					<div class="clear"></div>
				</div>

				@include( 'errors.profilError' )
			</form>
		</div>
	</div>


@endsection