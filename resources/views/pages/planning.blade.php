<?php 
use Carbon\Carbon;
use App\Course;
setlocale( LC_ALL, 'fr_FR'); 
?>

@extends('layout')
@section('title', $title)
@section('content')
	<h2>Mon planning&nbsp;:</h2>
	@if( Auth::user()->status == 1 )
		<div class="dropdown text-right">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ajouter
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
				<li><a href="{!! action( 'WorkController@create' ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'TestController@create' ) !!}">Une interrogation</a></li>
				<li><a href="{!! action( 'CourseController@addNews' ) !!}">Une notification</a></li>
			</ul>
		</div>
	@endif


	<div class="planning">
		<h3>{{ $monday->formatLocalized('%A %d %B %Y') }}</h3>
		
		<h3>{{ $tuesday->formatLocalized('%A %d %B %Y') }}</h3>

		<h3>{{ $wednesday->formatLocalized('%A %d %B %Y') }}</h3>

		<h3>{{ $thurstday->formatLocalized('%A %d %B %Y') }}</h3>

		<h3>{{ $friday->formatLocalized('%A %d %B %Y') }}</h3>

		<h3>{{ $saturday->formatLocalized('%A %d %B %Y') }}</h3>

		<h3>{{ $sunday->formatLocalized('%A %d %B %Y') }}</h3>

	<ul class="list-group">
		@foreach ($seances as $seance)
			@foreach ($seance as $the_seance)
				<li class="list-group-item">
					<dt>Séance du {{ $the_seance->start_hours->formatLocalized('%A %d %B %Y') }} à {{ $the_seance->start_hours->formatLocalized('%Hh%M') }}</dt>
					<br>
					@if ( count($the_seance->works) != 0 )
						<dt>Devoir:</dt>
						@foreach ($the_seance->works as $work)
							<dd>{{ $work->title }}</dd>
						@endforeach
					@endif
					@if ( count($the_seance->tests) != 0 )
						<dt>Interrogation:</dt>
						@foreach ($the_seance->tests as $test)
							<dd>{{ $test->title }}</dd>
						@endforeach
					@endif
				</li>
			@endforeach
		@endforeach
	</ul>

	</div>
	{{-- <div id="calendar"></div> --}}
@endsection