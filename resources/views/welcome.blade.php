@section('title', $title)
@include( 'header' )
<body class="home default">

<header class="home__header">
    <div class="home__connectZone">
        <a href="#connectZone" class="unlink home__register--link">inscription&#8239;/&#8239;connexion</a>
    </div>
    <a class="home__mainLogo--link" href="{!! action( 'CourseController@index' ) !!}">
        <h1 class="home__mainLogo--title">logo Stucher</h1>
    </a>
</header>
<div class="home__imageContainer">
    <div class="home__imageContainer__content">
        <h2 class="home__imageContainer__title">Un journal de classe entre le professeurs et ses élèves</h2>
        <div class="home__imageColor"></div>
        <img class="home__imageContainer__image" src="{{ url() }}/img/bg_home_1.jpg" alt="image de fond header" width="1500" height="1000">
    </div>
    <a href="#home__presentation--1" class="home__arrowBottom unlink"><span class="icon-arrow-down"></span></a>
</div>
<div id="home__presentation--1" class="home__presentation home__presentation--1">
    <div class="home__box--left home__box">
        <div class="home__box--content">
            <h3>Un outil pratique pour organiser ses cours</h3>
            <p>Avec Stucher, c'est vous qui gérez vos cours&#8239;!</p>
            <p>Vous avez deux types de profils&#8239;: professeur ou élève et à partir de là, vous avez la possibilité d'interagir sur un journal de classe commun entre vous et vos élèves&#8239;/&#8239;professeurs.</p>
            <p>Tous vos cours sont au même endroit que vous enseignez ou étudiez dans un ou plusieurs établissements.</p>
            <p class="leader">Pourquoi faire compliqué quand il y a Stucher&#8239;!</p>
        </div>
    </div>
    <div class="home__box--right home__box--image">
        <img src="{{ url() }}/img/home_main_tel.jpg" alt="illustration du calendrier de l'application" width="960">
    </div>
    <div class="clear"></div>
</div>

<div class="home__presentation home__presentation--connect">
    <div class="home__box--right home__box">
        <div class="home__box--content">
            <h3 id="connectZone" class="connectTitle">Essayez-le maintenant, c'est gratuit&nbsp!</h3>

            <form class="home__form" method="POST" action="/auth/login">
                {!! csrf_field() !!}

                <div class="home__separator"><span>CONNEXION</span></div>

                <div class="form-group">
                    <label class="home__box__label" for="email">Email&nbsp:</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label class="home__box__label" for="password">Mot de passe&nbsp:</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <input class="form__remember" type="checkbox" checked id="remember" name="remember"> <label for="remember">Se souvenir de moi</label>
                    <a class="unlink forgetPassword" href="{{ action( 'Auth\PasswordController@getEmail' ) }}">J'ai oublié mon mot de passe</a>
                </div>

                <div class="form-group">
                    <button class="home__btn home__send home__formButton" type="submit">Connexion</button>
                </div>

                <div class="home__separator"><span>OU INSCRIPTION</span></div>

                <div class="form-group">
                    <a href="{{ action( 'PageController@registerStudent' ) }}" class="unlink home__formButton home__link--register home__link--register--student" type="submit">Élève</a>
                    <a href="{{ action( 'PageController@registerTeacher' ) }}" class="unlink home__formButton home__link--register home__link--register--teacher" type="submit">Prefesseur</a>
                    <div class="clear"></div>
                </div>

                @include( 'errors.profilError' )
            </form>

        </div>
    </div>

    <div class="home__box--left home__box--image">
        <img src="{{ url() }}/img/home_classroom.jpg" alt="illustration d'une classe connectée" width="1000">
    </div>
    <div class="clear"></div>
</div>

<footer class="home_footer">
    Créé par <a class="unlink" href="http://loic-parent.be">Loïc Parent</a> en 2016
</footer>

@include( 'footer' )