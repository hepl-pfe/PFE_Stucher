@extends( 'layout' )
    @section('title', $title)
    @section( 'content' )
    <h1>{{$title}}</h1>
    <a href="{{ action( 'CoursesController@index' ) }}" class="btn btn-warning">Retour</a>

    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}

        <div class="form-group col-sm-8">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                <!-- old()  => est une variable temporaire qui récupère (le temps d'une requete) les information SANS le mot de passe histoire d’éviter de devoir TOUT retapper. -->
        </div>

        <div class="form-group col-sm-8">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="form-group col-sm-8">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>

        <div class="form-group col-sm-8">
            <label for="password_confirmation">Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <div class="form-group col-sm-8">
        	<input class="form-control" type="hidden" name="status" id="teacher" value="1">
            <button class="btn btn-default" type="submit">Register</button>
        </div>
    </form>

@stop