@extends('layout')
@section('title', $title)
@section('content')
	<h2>Mes notifications&nbsp;:</h2>
	@if( Auth::user()->status == 1 )
		{{-- <a class="btn btn-primary" style="margin: 1em;" href="{!! action( 'CourseController@addNews' ) !!}">Ajouter une notification</a>	 --}}

		@if ( count($notifications) != 'null' )
			<ul class="list-group">
				@foreach ($notifications as $not)
				<li class="list-group-item">{{$not->user_name}} {{$not->not_title}} {{$not->course_title}}</li>
				@endforeach
			</ul>
			{!! $notifications->render() !!}
		@else
			<ul class="list-group">
				<li class="list-group-item">Aucune notification pour le moment</li>
			</ul>
		@endif
	@elseif( Auth::user()->status == 2 )
		<ul class="list-group">
			<li class="list-group-item">Aucune notification pour le moment</li>
		</ul>
	@endif

@endsection