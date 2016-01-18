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








	{{-- <div id="calendar"></div> --}}
@endsection