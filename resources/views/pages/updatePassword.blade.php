@extends('layout')
@section('title', $title)
@section('content')

    <div class="blockTitle">
        <h2 class="mainTitle">{{ $title }}</h2>
    </div>

    <div class="box--group">
        <div class="box box--shadow">
            <form class="box__group--content" action="" method="post">
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
                @include('errors.profilError')
            </form>
        </div>
    </div>


@endsection