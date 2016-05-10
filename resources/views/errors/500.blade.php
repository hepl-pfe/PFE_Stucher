@extends('logoutLayout')
@section('title', 'Stucher • problème sur le serveur')
@section('content')

    <body class="{{ isset(Auth::user()->color) ? Auth::user()->color : '' }}">
    <h1>ERREUR 500</h1>
    <p>Une erreur du serveur est survenue. Veuillez ré-essayer plus tard.</p>
@stop