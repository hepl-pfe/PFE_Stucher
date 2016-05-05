@extends('layout')
@section('title', $title)
@section('content')
	<div class="blockTitle">
		<h2 class="mainTitle">{{ $title }}</h2>
	</div>

	<div class="box--group">
		<!-- Profil photo -->
		<div class="box_profilPicture box__profilImage box__profilImage--profilPage">
			<img class="box__profilImage" src="{{ url() }}/img/profilPicture/{{ Auth::user()->image }}" alt="Image de profil">
			<a class="image__bottombutton" href="{{ action( 'PageController@changePicture' ) }}">Changer la photo</a>
		</div>
		<!-- id information -->
		<div class="box box--shadow box_profil--picture">
			<ul class="box__group--list profil__group--list">
				<li class="box__group--list--list box__profilInformation">
					<h3><span class="icon icon--text icon--text--aboutPage icon-user mainColorfont"></span> {{ $user->firstname }} {{ $user->name }}</h3>
				</li>
				<li class="box__group--list--list box__profilInformation">
					<a class="unlink" href="mailto:{{$user->email}}">
						<span class="icon icon--text icon--text--aboutPage icon-envelope mainColorfont"></span>
						{{ $user->email }}
					</a>
				</li>
				<li class="box__group--list--list box__profilInformation">
					<span class="icon icon--text icon--text--aboutPage icon-badge mainColorfont"></span>
					@if( $user->status == 1 )
						Professeur
					@else
						Élève
					@endif
				</li>
			</ul>
		</div>

	</div>
@endsection