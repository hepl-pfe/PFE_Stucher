@extends('logoutLayout')
@section('title', 'Page non trouvée • Stucher')
@section('content')

    <body class="{{ isset(Auth::user()->color) ? Auth::user()->color : '' }}">
        <h1>ERREUR 404</h1>
        <p>On dirait que la page que vous cherchez à accédé n'est pas disponible.</p>
@stop