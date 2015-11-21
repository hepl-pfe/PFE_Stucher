@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
		@if( Auth::user()->status == 1 )
			<div class="dropdown text-right">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ajouter
				<span class="caret"></span></button>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="{!! action( 'CoursesController@create' ) !!}">Un cours</a></li>
					<li><a href="{!! action( 'CoursesController@addWork' ) !!}">Un devoir</a></li>
					<li><a href="{!! action( 'CoursesController@addTest' ) !!}">Une interrogation</a></li>
					<li><a href="{!! action( 'CoursesController@addNews' ) !!}">Une notification</a></li>
				</ul>
			</div>
		@elseif( Auth::user()->status == 2 )
			<a class="btn btn-primary" href="{!! action( 'CoursesController@add' ) !!}">Ajouter un cours</a>
		@endif
		@if( Auth::user()->status == 1 )
			<h2>Tous mes cours</h2>
			<ul class="list-group">
		    	<li class="list-group-item well well-lg"><a href="{{ action( 'CoursesController@view', [ 'id' => 18, 'action' => 1 ] ) }}">Cours de nréerlandais (groupe: 3TQ)</a></li>
		    	<li class="list-group-item well well-lg"><a href="">Cours de nréerlandais (groupe: 4TQ-2)</a></li>
		    	<li class="list-group-item well well-lg"><a href="">Cours de français (groupe: 3TQ)</a></li>
	    	</ul>
		@elseif( Auth::user()->status == 2 )
			<h2>Tous mes cours</h2>
			<ul class="list-group">
		    	<li class="list-group-item well well-lg"><a href="{{ action( 'CoursesController@view', [ 'id' => 18, 'action' => 1 ] ) }}">Cours de nréerlandais</a></li>
	    	</ul>
		@endif
@stop