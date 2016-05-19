@extends( 'layout' )
@section( 'content' )
@section( 'title', $title )

<div class="blockTitle">
	<h2 class="mainTitle">Les élèves du cours</h2>
	<a title="Revenir au cours" class="backButton blockTitle__backButton unlink mainColorfont" href="{!! action( 'CourseController@view', [ 'id' => $course->id ] ) !!}"><span class="hidden">Revenir au cours</span><span class="icon-arrow-left"></span></a>
</div>

<!-- dd_moreButton -->
@if( \Auth::user()->status == 1 )
	<div class="dd_moreButton">
		<input type="checkbox" id="dd_moreButton">
		<label for="dd_moreButton" class="dd_moreButton--button"><span></span><span></span></label>

		<ul class="dd_moreButton--content">
			<li><a href="{!! action( 'CourseController@create' ) !!}">Ajouter un cours</a></li>
		</ul>
	</div>
@endif

	</div>

@stop