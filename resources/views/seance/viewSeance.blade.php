<?php use Carbon\Carbon; ?>


@extends( 'layout' )
    @section( 'content' )
    @section( 'title', $title )
	<h1>{{$title}}</h1>
	<a class="btn btn-warning" href="{!! action( 'CourseController@view', [ "id" => $seance->course_id, "action" => 1 ] ) !!}"><—</a>
@stop