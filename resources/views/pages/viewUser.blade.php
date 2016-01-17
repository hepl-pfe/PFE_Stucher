@extends('layout')
@section('title', $title)
@section('content')
	<h2 class="text-center">{{ $title }}</h2>
	<h3 class="text-center">Nom: {{ $user->name }}</h3>
	<p class="text-center">Email: {{ $user->email }}</p>
	<a href="mailto:{{$user->email}}" class="btn btn-primary">Contacter {{$user->name}}</a>
@endsection