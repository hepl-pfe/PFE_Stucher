<?php use App\User; ?>
@extends( 'layout' )
@section('title', $title)
@section( 'content' )

    <div class="blockTitle">
        <h2 class="mainTitle">{{ $title }}</h2>
    </div>

    <!-- dd_moreButton -->
    <div class="dd_moreButton">
        <input type="checkbox" id="dd_moreButton">
        <label for="dd_moreButton" class="dd_moreButton--button"><span></span><span></span></label>

        <ul class="dd_moreButton--content">
            <li><a href="{!! action( 'CourseController@create' ) !!}">Ajouter un cours</a></li>
        </ul>
    </div>

    <ul>
        @foreach( $waitCourses as $waitCourse )
            <li class=""><a href="">{{ $waitCourse ->title }} <span class="pull-right">en attente de validation</span> <a class="btn btn-danger pull-right" href="{!! action( 'CourseController@removeCourse', [ 'id' => $waitCourse->id ] ) !!}">Annuler la demande</a></a></li>
        @endforeach
    </ul>

@stop