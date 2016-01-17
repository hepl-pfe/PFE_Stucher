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
			<input type="date" class="form-control" name="start_hours" id="start_hours" value="{{ $start_hours }}">
		</div>

		<div class="form-group">
			<label for="end_hours">heure de fin</label>
			<input type="date" class="form-control" name="end_hours" id="end_hours" value="{{ $end_hours }}">
		</div>

		<div class="form-group text-center">
			<a class="btn btn-warning" href="{!! action( 'SeanceController@view', ['id' => $id] ) !!}">Annuler</a>
			<input type="submit" class="btn btn-primary" value="Valider les modifications">
		</div>
		@include( 'errors.profilError' )
	</form>

@endsection