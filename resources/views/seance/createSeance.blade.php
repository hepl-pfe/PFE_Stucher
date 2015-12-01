@extends('layout')
@section('title', $title)
@section('content')

	<h2>{{ $title }}</h2>
	<form action="" method="post">
		<div class="form-group">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="course">Pour le cours de…</label>
			<select class="form-control" name="course" id="title">
            	@foreach( $courses as $course )
	            	<option @if($course->id == $id)selected="selected" @endif value="{{ $course->id }}">{{ $course->title }}</option>
            	@endforeach
            </select>
		
		<div class="form-group">
			<label for="daypicker">Pour quel jour</label>
			<select name="daypicker" id="daypicker">
				<option value="monday">Lundi</option>
				<option value="tuesday">Mardi</option>
				<option value="wednesday">Mercredi</option>
				<option value="thursday">Jeudi</option>
				<option value="friday">Vendredi</option>
				<option value="saturday">Samedi</option>
				<option value="sunday">Dimanche</option>
			</select>
		</div>

		<fieldset>
			<div class="form-group">
				<label for="datepicker">Début de période</label>
				<input type="start_date" class="form-control" name="start_date" id="datepicker_start">
			</div>
			<div class="form-group">
				<label for="datepicker">Fin de période</label>
				<input type="end_date" class="form-control" name="end_date" id="datepicker_end">
			</div>
		</fieldset>

		<div class="form-group">
			<label for="start_hours">heure de début</label>
			<input type="date" class="form-control" name="start_hours" id="start_hours">
		</div>

		<div class="form-group">
			<label for="end_hours">heure de fin</label>
			<input type="date" class="form-control" name="end_hours" id="end_hours">
		</div>

		<div class="form-group text-center">
			<input type="submit" class="btn btn-primary" value="Ajouter la séance au cours">
			<a class="btn btn-warning" href="{!! action( 'CourseController@view', ['id' => $id, 'action' => 1] ) !!}">Retour au cours</a>
		</div>
	</form>

@endsection