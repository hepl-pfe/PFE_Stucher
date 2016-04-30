@extends( 'layout' )
@section( 'content' )
@section( 'title', $title )
    <h2>{{ $title }}</h2>
    <a class="btn btn-warning" href="{!! action( 'CourseController@searchCourse' ) !!}">Retour</a>
@stop