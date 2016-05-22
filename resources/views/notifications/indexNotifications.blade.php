@extends('layout')
@section('title', $title)
@section('content')
	<div class="blockTitle">
		<h2 class="mainTitle">Notifications</h2>
	</div>
	@if( Auth::check() )
		<ul class="notification__group__page">
			@if ( count($notifications) != 'null' )
				@foreach ($notifications as $not)
					@include( 'notifications.notificationContent' )
				@endforeach
			{!! $notifications->render() !!}
		@else
			<li class="item--null">Aucune notification pour le moment</li>
		@endif
		</ul>
	@endif

@endsection