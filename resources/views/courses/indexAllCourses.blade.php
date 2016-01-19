@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
    <h2 class="pageTitle">Tous les cours existants</h2>
    <div class="spaceContainer">
        <a class="btn btn-warning" href="{!! action( 'CourseController@index' ) !!}"><—</a><br><br>
        <form action="{!! action( 'CourseController@getByToken') !!}" method="post" class="form-group">
        	<label for="searchToken">Code d'accès</label>
        	<input id="searchToken" name="searchToken" type="text" placeholder="ex: 2345D3">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" value="Rechercher le cours">
        </form>
    	<ul class="list-group">
    		@foreach ($courses as $course)
    			<li class="list-group-item well well-lg"><a href="{!! action( 'CourseController@view', [ 'id' => $course->id, 'action' => 2 ] ) !!}">{{ $course->title }} ({{ $course->group }})</a></li>
    		@endforeach
    	</ul>
    </div>
@stop