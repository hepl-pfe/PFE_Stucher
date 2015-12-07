@extends('layout')
@section('title', $title)
@section('content')
	<h2>Mes notifications&nbsp;:</h2>
	@if( Auth::user()->status == 1 )
		<a class="btn btn-primary" style="margin: 1em;" href="{!! action( 'CourseController@addNews' ) !!}">Ajouter une notification</a>	
		<ul class="list-group">
			<li class="list-group-item">Aucune notification pour le moment</li>
		</ul>
	@elseif( Auth::user()->status == 2 )
		<ul class="list-group">
			<li class="list-group-item">Aucune notification pour le moment</li>
		</ul>
	@endif
@endsection