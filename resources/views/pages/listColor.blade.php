@extends('layout')
@section('title', $title)
@section('content')
    <div class="blockTitle">
        <h2 class="mainTitle">Thème couleur</h2>
    </div>

    <!-- dd_moreButton -->
    <div class="dd_moreButton">
        <input type="checkbox" id="dd_moreButton">
        <label for="dd_moreButton" class="dd_moreButton--button"><span></span><span></span></label>

        <ul class="dd_moreButton--content">
            <li><a href="{!! action( 'CourseController@create' ) !!}">Créer un cours</a></li>
            <li><a href="{!! action( 'PageController@editProfil' ) !!}">Modifier mon profil</a></li>
            <li><a href="{{ action( 'PageController@changePicture' ) }}">Changer la photo de profil</a></li>
            <li><a href="{!! action( 'PageController@deleteProfil' ) !!}">Supprimer mon compte</a></li>
        </ul>
    </div>

    <ul class="selectColor">
        <li class="color-1 even"><a class="unlink hideText" href="{{ action( 'PageController@updateColor', ['$number' => '1'] ) }}">Couleur 1</a></li>
        <li class="color-2 odd"><a class="unlink hideText" href="{{ action( 'PageController@updateColor', ['$number' => '2'] ) }}">Couleur 2</a></li>
        <li class="color-3 even"><a class="unlink hideText" href="{{ action( 'PageController@updateColor', ['$number' => '3'] ) }}">Couleur 3</a></li>
    </ul>
@endsection