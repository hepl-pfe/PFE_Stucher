@extends('layout')
@section('title', $title)
@section('content')
	<div class="blockTitle">
		<h2 class="mainTitle">Mon profil</h2>
		<a href="{!! action( 'PageController@editProfil' ) !!}" class="unlink mainColorfont blockTitle--edit">
			<span class="icon-pencil icon icon--edit"></span> <span class="hidden">Modifier mon profil</span>
		</a>
	</div>

		</div>
		<div class="aboutPage__label--rightSide">
			<h3 class="aboutPage__label">Prénom: <span>{{ Auth::user()->firstname }}</span></h3>
			<h3 class="aboutPage__label">Nom: <span>{{ Auth::user()->name }}</span></h3>
			<p class="aboutPage__label">Email: <span>{{ Auth::user()->email }}</span></p>
		</div>
		<div class="clear"></div>
		<div class="aboutPage__label--bottomContent">
			<div class="aboutPage__info--container">
				@if( Auth::user()->status == 1 )
					<a class="aboutPage__info" href="{{ action( 'CourseController@index' ) }}">
					<span>Nombre de cours:</span>
					<span>{{ $nbCourses }}</span>
					</a>
					<a class="aboutPage__info" href="">
					<span>Nombre d'élève:</span>
					<span>{{ $nbUsers }}</span></a>
				@elseif( Auth::user()->status == 2 )
					<a class="aboutPage__info--alone" href="{{ action( 'CourseController@index' ) }}">
					<span>Nombre de cours:</span>
					<span>{{ $nbCoursesStudent }}</span></a>
				@endif
				<div class="clear"></div>
			</div>
			<div class="aboutPage__info--container--2">
				<a href="{!! action( 'PageController@editProfil' ) !!}" class="btn btn-warning">Modifier mon profil</a>
				<a href="{!! action( 'PageController@deleteProfil' ) !!}" class="btn btn-warning">Supprimer mon profil</a>
			</div>
		</div>
	</div>
@endsection