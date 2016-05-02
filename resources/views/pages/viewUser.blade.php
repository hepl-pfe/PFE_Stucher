@extends('layout')
@section('title', $title)
@section('content')
	<h2 class="mainTitle">{{ $title }}</h2>
	<div class="image__container image__container--aboutPage">
		<img src="{{ url() }}/img/profilPicture/{{ $user->image }}" alt="Image de profil">
	</div>
	<div class="aboutPage__label--rightSide">
		<h3 class="aboutPage__label">Prénom: <span>{{ $user->firstname }}</span></h3>
		<h3 class="aboutPage__label">Nom: <span>{{ $user->name }}</span></h3>
		<p class="aboutPage__label">Email: <span>{{ $user->email }}</span></p>
	</div>
	<div class="clear"></div>
	<a href="mailto:{{$user->email}}" class="btn btn_addSeance">Contacter {{$user->name}}</a>
@endsection