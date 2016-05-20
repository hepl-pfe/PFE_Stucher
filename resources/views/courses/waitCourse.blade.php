@extends( 'layout' )
@section( 'content' )
@section( 'title', $title )
<div class="blockTitle">
    <h2 class="mainTitle">{{ $title }}</h2>
</div>
    <h3>Cours en attente de validation</h3>
    <a class="btn btn-warning" href="{!! action( 'CourseController@searchCourse' ) !!}">Retour</a>
@stop