@extends('layout')
@section('title', $title)
@section('content')
	<h2>Mes notifications&nbsp;:</h2>
	@if( Auth::user()->status == 1 )
		<a class="btn btn-primary" style="margin: 1em;" href="">Ajouter une notification</a>	
		<ul class="list-group">
			<li class="list-group-item">Nouveau message de Grégory Lemmens (du cours de Français)<a href="{{ action( 'PageController@message' ) }}" class="btn badge">Voir le message</a></li>
			<li class="list-group-item">
			<a href="">Jonathan Petit</a> demande l’accès au cours de <a href="{{ action( 'CourseController@view', [ 'id' => 18 ] ) }}">Néérlandais 3TQ</a><a class="btn badge btn-danger">Refuser</a><a class="btn badge btn-success">Ajouter</a>
			</li>
		</ul>
	@elseif( Auth::user()->status == 2 )
		<ul class="list-group">
			<li class="list-group-item">M. Gerrard sera absent le 20/10/16</li>
			<li class="list-group-item">Nouveau message de M. David<a href="{{ action( 'PageController@message' ) }}" class="btn badge">Voir le message</a></li>
			<li class="list-group-item">Nouveau devoir pour le 20/10/16 <a href="{{ action( 'PageController@planning' ) }}" class="btn badge">Voir le devoir</a></li>
			<li class="list-group-item">Votre demande d’ajout au cours de Néerlandais de M. Poinvert à été accepter<a href="{{ action( 'CourseController@view', ['id' => 18, 'action' => 1] ) }}" class="btn badge">Accéder au cours</a></li>
		</ul>
	@endif
@endsection