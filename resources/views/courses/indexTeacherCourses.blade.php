@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
		<h2 class="pageTitle">Tous mes cours</h2>

		<ul>
			@if ( $courses->count() == null )
				<li class="list__empty">Aucun cours pour le moment</li>
			@endif
			@foreach ($courses as $course)
				<li class="list__round">
					<a href="{!! action( 'CourseController@view', [ 'id' => $course->id ] ) !!}">
						<span class="list__name">Cours de {{ $course->title }}</span>
						<span class="list__group">groupe {{ $course->group }}</span>
					</a>
				</li>
			@endforeach
	    		<li class="list__round list__round--empty">
	    			<a href="{!! action( 'CourseController@create' ) !!}">Créer un nouveau cours</a>
	    		</li>
    	</ul>
    	@include( 'errors.profilError' )
@stop