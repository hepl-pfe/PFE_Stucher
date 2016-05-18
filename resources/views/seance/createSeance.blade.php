@extends('layout')
@section('title', $title)
@section('content')

	<div class="blockTitle">
		<h2 class="mainTitle">{{ $title }}</h2>
	</div>

	<div class="spaceContainer">
		<form action="" method="post">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="course" value="{{ $id }}">
			</div>

			<div class="form-group">
				<label for="daypicker">Pour quel jour</label>
				<select name="daypicker" id="daypicker">
					@foreach ($days as $day => $jour)
						<option value="{{ $day }}">{{ $jour }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="datepicker_start">Début de période</label>
				<input type="date" class="start_date" name="start_date" id="datepicker_start" data-field="date" data-startend="start" data-startendelem=".end_date" readonly value="{{ $today }}">
			</div>

			<div class="form-group">
				<label for="datepicker_end">Fin de période</label>
				<input type="date" class="end_date" name="end_date" id="datepicker_end" data-field="date" data-startend="end" data-startendelem=".start_date" readonly placeholder="{{ $tomorrow }}">
			</div>

			<div class="form-group">
				<label for="start_hours">heure de début</label>
				<input type="time" class="start_hours" name="start_hours" id="start_hours" value="08:00" data-field="time" data-startend="start" data-format="hh:mm" data-startendelem=".end_hours" readonly>
			</div>

			<div class="form-group">
				<label for="end_hours">heure de fin</label>
				<input type="time" class="end_hours" name="end_hours" id="end_hours" placeholder="10:00" data-field="time" data-format="hh:mm" data-startend="end" data-startendelem=".start_hours" readonly>
			</div>

			<div class="form-group text-center">
				<a class="btn btn-back" href="{!! action( 'CourseController@view', ['id' => $id, 'action' => 1] ) !!}">Annuler</a>
				<input type="submit" class="btn btn-send" value="Générer les séances">
				<div class="clear"></div>
			</div>

			<div id="dtBox"></div>

			@include( 'errors.profilError' )
		</form>
	</div>

@endsection