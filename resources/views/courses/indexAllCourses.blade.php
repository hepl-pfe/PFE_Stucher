@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
        <div class="blockTitle">
            <h2 class="mainTitle">Tous les cours existants</h2>
            <a class="backButton blockTitle__backButton unlink mainColorfont" href="{!! action( 'CourseController@index' ) !!}"><span class="hidden">Revenir à la page précédente</span><span class="icon-arrow-left"></span></a>
        </div>

    <div class="spaceContainer">
        <form action="{!! action( 'CourseController@getByToken') !!}" method="post" class="form-group">
        	<label for="searchToken">Code d'accès</label>
        	<input id="searchToken" name="searchToken" type="text" placeholder="ex: 2345D3">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" value="Rechercher le cours">
            @include('errors.profilError')
        </form>
    	<ul class="list-group">
    		@foreach ($courses as $course)
    			<li class="list-group-item well well-lg"><a href="{!! action( 'CourseController@view', [ 'id' => $course->id ] ) !!}">{{ $course->title }} ({{ $course->group }})</a></li>
    		@endforeach
    	</ul>
    </div>
@stop