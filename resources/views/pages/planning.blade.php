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

	
<?php
    // Basé sur le code de : http://codes-sources.commentcamarche.net/source/42344-calendrier-par-semaine-avec-actions
    
    if(isset($_GET["lundi"])) // Une semaine précise est demandée
    {
        $ts = $_GET["lundi"];
    }
    else //On prendra la semaine d'aujourd'hui
    {
        $day = (date('w') - 1); //Jour dans la semaine... Lundi = 0
        $diff = $day * 86400; //Différence en secondes par rapport au lundi
        $ts = (time() - $diff); //On récupère le TimeStamp du lundi
        //$ts = time();


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