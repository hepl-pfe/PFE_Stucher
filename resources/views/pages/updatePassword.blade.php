@extends('layout')
@section('title', $title)
@section('content')

    <h2 class="pageTitle">{{ $title }}</h2>

    <div class="spaceContainer">
        <form action="" method="post">
            <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="password">votre nouveau mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" >
            </div>

            <div class="form-group">
                <label for="password_confirmation">valider le nouveau mot de passe</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>

            <div class="form-group">
                <a href="{{ action( 'PageController@editProfil' ) }}" class="btn btn-back">Annuler</a>
                <input type="submit" class="btn btn-send" value="Valider les modifications">
                <div class="clear"></div>
            </div>
        </form>
        @include('errors.profilError')
    </div>

@endsection