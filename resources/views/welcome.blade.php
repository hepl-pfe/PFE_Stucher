@section('title', $title)
@include( 'header' )
<body class="home default">

<header class="home__header">
    <div class="home__connectZone">
        <a href="{{ action( 'Auth\AuthController@getRegister' ) }}" class="unlink home__register--link">Inscription</a>
        <a href="{{ action( 'Auth\AuthController@getLogin' ) }}" class="unlink home__register--link">Connexion</a>
    </div>
    <a class="home__mainLogo--link" href="{!! action( 'CourseController@index' ) !!}">
        <h1 class="home__mainLogo--title">Stucher</h1>
    </a>
</header>
<div class="home__imageContainer">
    <div class="home__imageContainer__content">
        <h2 class="home__imageContainer__title">Un journal de classe entre le professeur et ses élèves</h2>
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
            <p>Tous vos cours sont au même endroit que vous enseigniez ou étudiez dans un ou plusieurs établissements.</p>
            <p class="leader">Pourquoi faire compliqué quand il y a Stucher&#8239;!</p>
        </div>
    </div>
    <div class="home__box--right home__box--image">
        <img src="{{ url() }}/img/home_main_tel.jpg" alt="illustration du calendrier de l'application" width="960">
    </div>
    <div class="clear"></div>
</div>

<div id="home__presentation--2" class="home__presentation home__presentation--2">
    <div class="home__presentation--content home__presentation--2--content home__presentation--2--content--1">
        <div class="presentation__icon">
            <img src="{{ url() }}/img/presentation-item-01.svg" alt="" width="150" height="150">
        </div>
        <div class="presentation__content">
            <h4>C'est vous qui planifiez&#8239;!</h4>
            <p>
                Planifiez vos séances et ajoutez vos devoirs et interrogations
            </p>
        </div>
    </div>

    <div class="home__presentation--content home__presentation--2--content home__presentation--2--content--2">
        <div class="presentation__icon">
            <img src="{{ url() }}/img/presentation-item-02.svg" alt="" width="150" hheight="150">
        </div>
        <div class="presentation__content">
            <h4>Partout avec vous</h4>
            <p>
                Créez et gérez vos cours depuis l'appareil de votre choix
            </p>
        </div>
    </div>

    <div class="home__presentation--content home__presentation--2--content home__presentation--2--content--3">
        <div class="presentation__icon">
            <img src="{{ url() }}/img/presentation-item-03.svg" alt="" width="150" height="150">
        </div>
        <div class="presentation__content">
            <h4>Toujours au courant</h4>
            <p>
                Restez informés de ce qu'il se passe avec vos cours grâce à un système de notifications
            </p>
        </div>
    </div>

    <div class="home__presentation--content home__presentation--2--content home__presentation--2--content--4">
        <div class="presentation__icon">
            <img src="{{ url() }}/img/presentation-item-04.svg" alt="" width="150" height="150">
        </div>
        <div class="presentation__content">
            <h4>Gérez l'accès à vos cours</h4>
            <p>
                C'est vous qui choisissez de donner l’accès à un cours ou non.
            </p>
        </div>
    </div>

    <div class="clear"></div>
</div>


<div class="home__presentation home__presentation--connect">
    <div class="home__box--right home__box">
        <div class="home__box--content">
            <h3 id="connectZone" class="connectTitle">Essayez-le maintenant, c'est gratuit&nbsp!</h3>
            <a href="{{ action( 'Auth\AuthController@getLogin' ) }}">Se connecter</a>
            <a href="{{ action( 'Auth\AuthController@getRegister' ) }}">S'inscrire</a>
        </div>
    </div>

    <div class="home__box--left home__box--image">
        <img src="{{ url() }}/img/home_classroom.jpg" alt="illustration d'une classe connectée" width="1000">
    </div>
    <div class="clear"></div>
</div>


<footer class="home_footer">
    <div class="home_footer--1 home_footer--content">
        <img src="{{ url() }}/img/logo_footer_home.svg" alt="Logo stucher" width="120" height="144">
    </div>

    <div class="home_footer--2 home_footer--content">
        <ul>
            <li><a href="{{ action( 'PageController@planDuSite' ) }}">Plan du site</a></li>
            <li><a href="{{ action( 'PageController@useRights' ) }}">Conditions d'utilisation</a></li>
            <li><a href="https://github.com/loicparent/PFE_Stucher">Repo Github</a></li>
        </ul>
    </div>

    <div class="home_footer--3 home_footer--content">
        <h3>Suivez-nous sur…</h3>
        <a href="https://www.facebook.com/stucherapp/" class="followLink followLinkFb unlink"><span class="icon icon-social-facebook"></span>Facebook</a>
        {{--<a href="https://www.facebook.com/stucherapp/" class="followLink followLinkTw unlink"><span class="icon icon-social-twitter"></span>Twitter</a>--}}
        <a href="http://loic-parent.be" class="logoByLoic unlink">
            <img src="{{ url() }}/img/logoByLoic.svg" alt="Logo by Loic Parent" width="200" height="35">
        </a>
    </div>

    <div class="clear"></div>

</footer>

@include( 'footer' )