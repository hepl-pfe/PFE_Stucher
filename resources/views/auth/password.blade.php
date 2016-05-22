@section('title', 'Mot de passe oublié • Stucher')
@include( 'header' )
<body class="home default">

<!-- resources/views/auth/password.blade.php -->
<div class="blockTitle">
    <h2 class="mainTitle">Mot de passe oublié</h2>
    <a title="Revenir à la page précédente" class="backButton blockTitle__backButton unlink mainColorfont" href="{!! URL::previous() !!}"><span class="hidden">Revenir à la page précédente</span><span class="icon-arrow-left"></span></a>
</div>


<div class="box--group">
    <div class="box box--shadow box__connect--page">
        <form class="box__group--content" method="POST" action="/password/email">
            {!! csrf_field() !!}

            <div class="form-group">
                <label class="color_label" for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" autofocus>
            </div>

            <div class="form-group--button">
                <button class="btn btn-send" type="submit">Envoyez un lien par email</button>
                <div class="clear"></div>
            </div>

            @include( 'errors.profilError' )

        </form>
    </div>
</div>

@include( 'footer' )
