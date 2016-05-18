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
				<label for="course">Pour le cours de…</label>
				<select class="form-control" name="course" id="course">
	            	@foreach( $courses as $course )
		            	<option @if($course->id == $course_id)selected="selected" @endif value="{{ $course->id }}">{{ $course->title }}</option>
	            	@endforeach
	            </select>
	        </div>

			<div class="form-group">
				<label for="datepicker_start">Pour quel jour?</label>
				<input type="date" class="form-control" name="date" id="datepicker_start" value="{{ $start_day }}">
			</div>

			<div class="form-group">
				<label for="start_hours">heure de début</label>
				<input type="time" class="start_hours" name="start_hours" id="start_hours" value="{{ $start_hours }}" data-field="time" data-startend="start" data-format="hh:mm" data-startendelem=".end_hours" readonly>
			</div>

			<div class="form-group">
				<label for="end_hours">heure de fin</label>
				<input type="time" class="end_hours" name="end_hours" id="end_hours" value="{{ $end_hours }}" data-field="time" data-format="hh:mm" data-startend="end" data-startendelem=".start_hours" readonly>
			</div>

			<div class="form-group text-center">
				<input type="submit" class="btn btn-send" value="Valider les modifications">
				<a class="btn btn-back" href="{!! action( 'SeanceController@view', ['id' => $id] ) !!}">Annuler</a>
			</div>
			<div id="dtBox"></div>
			@include( 'errors.profilError' )
		</form>
	</div>

@endsection