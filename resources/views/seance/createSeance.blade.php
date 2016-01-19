@extends('layout')
@section('title', $title)
@section('content')

	<h2 class="pageTitle">{{ $title }}</h2>
	<div class="spaceContainer">
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
					@foreach ($days as $day => $jour)
						<option value="{{ $day }}">{{ $jour }}</option>
					@endforeach
				</select>
			</div>

			<fieldset>
				<div class="form-group">
					<label for="datepicker">Début de période</label>
					<input type="start_date" class="form-control" name="start_date" id="datepicker_start" value="{{ $today }}">
				</div>
				<div class="form-group">
					<label for="datepicker">Fin de période</label>
					<input type="end_date" class="form-control" name="end_date" id="datepicker_end" value="{{ $tomorrow }}">
				</div>
			</fieldset>

			<div class="form-group">
				<label for="start_hours">heure de début</label>
				<input type="date" class="form-control" name="start_hours" id="start_hours" value="08:00">
			</div>

			<div class="form-group">
				<label for="end_hours">heure de fin</label>
				<input type="date" class="form-control" name="end_hours" id="end_hours" value="10:00">
			</div>

			<div class="form-group text-center">
				<a class="btn btn-back" href="{!! action( 'CourseController@view', ['id' => $id, 'action' => 1] ) !!}">Annuler</a>
				<input type="submit" class="btn btn-send" value="Générer les séances">
				<div class="clear"></div>
			</div>
			@include( 'errors.profilError' )
		</form>
	</div>

@endsection