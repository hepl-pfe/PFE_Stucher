@extends('logoutLayout')
@section('title', 'Problème sur le serveur • Stucher')
@section('content')

    <body class="{{ isset(Auth::user()->color) ? Auth::user()->color : '' }}">
    <h1>ERREUR 500</h1>
    <p>Une erreur du serveur est survenue. Veuillez ré-essayer plus tard.</p>
@stop