@extends('layout')
@section('title', $title)
@section('content')
	<h2 class="mainTitle">Mes informations&nbsp;:</h2>
	<div class="spaceContainer">
		<div class="image__container image__container--aboutPage">
			<img src="{{ url() }}/img/profilPicture/{{ Auth::user()->image }}" alt="Image de profil">
			<a class="image__bottombutton" href="{{ action( 'PageController@changePicture' ) }}">Modifier le photo de profil</a>
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