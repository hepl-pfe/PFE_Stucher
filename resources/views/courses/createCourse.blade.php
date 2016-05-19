@extends('layout')
@section('title', $title)
@section('content')
	<div class="blockTitle">
		<h2 class="mainTitle">Créer un nouveau cours</h2>
		<a title="Revenir à la liste des cours" class="backButton blockTitle__backButton unlink mainColorfont" href="{!! action( 'CourseController@index' ) !!}"><span class="hidden">Revenir à la page précédente</span><span class="icon-arrow-left"></span></a>
	</div>

	<div class="box--group">
		<div class="box box--shadow">
			<form class="box__group--content" action="" method="post">
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<label class="color_label" for="title">Intitulé du cours</label>
					<input type="text" class="form-control" name="title" id="title" placeholder="ex: Mathématiques" value="{{ old('title') }}" autofocus>
				</div>

				<div class="form-group">
					<label class="color_label" for="group">Nom du groupe</label>
					<input type="text" class="form-control" name="group" id="group" placeholder="ex: 3e gestion" value="{{ old('group') }}">
				</div>

				<div class="form-group">
					<label class="color_label" for="school">Établissement scolaire</label>
					<input type="text" class="form-control" name="school" id="school" placeholder="ex: Saint-luc" value="{{ old('school') }}">
				</div>

				<div class="form-group">
					<label class="color_label" for="place">Ville de cette école</label>
					<input type="text" class="form-control" name="place" id="place" placeholder="ex: Liège" value="{{ old('place') }}">
				</div>

				<div class="form-group--button text-center">
					<input type="submit" class="btn btn-send" value="Créer le cours">
					<div class="clear"></div>
				</div>

				@include( 'errors.profilError' )
			</form>
		</div>
	</div>


@endsection