@section('title', 'Inscription • Stucher')
@include( 'header' )
<body class="home default">

    <div class="blockTitle">
        <h2 class="mainTitle">Inscription</h2>
        <a title="Revenir à la page d’accueil" class="backButton blockTitle__backButton unlink mainColorfont" href="{!! route( 'home' ) !!}"><span class="hidden">Revenir à la page précédente</span><span class="icon-arrow-left"></span></a>
    </div>

    <div class="box--group">
        <div class="box box--shadow">
            <form class="box__group--content" method="POST" action="/register">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label class="color_label" for="firstname">Prénom</label>
                    <input class="form-control" type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" autofocus>
                </div>

                <div class="form-group">
                    <label class="color_label" for="name">Nom</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label class="color_label" for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label class="color_label" for="password">Mot de passe</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <label class="color_label" for="password_confirmation">Confirmation du mot de passe</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                </div>

                <div class="form-group">
                    <p>Vous êtes…</p>
                    <label for="teacher">Un professeur</label>
                    <input class="form-control" type="radio" name="status" id="teacher" value="1">

                    <label for="student">Un étudiant</label>
                    <input class="form-control" type="radio" name="status" id="student" value="2">
                </div>

                <div class="form-group--button">
                    <button class="btn btn-send" type="submit">S'inscrire</button>
                    <div class="clear"></div>
                </div>

                @include( 'errors.profilError' )
            </form>
        </div>
    </div>

@include( 'footer' )
