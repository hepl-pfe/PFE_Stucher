@section('title', $title)
@include( 'header' )
<body class="default logOutPages">

<header class="simpleHeader">

    <a class="simpleHeader__logo noprint" href="{!! action( 'CourseController@index' ) !!}">
        <h1>Stucher</h1>
    </a>
    <img class="mainLogo--print hidden" src="{{ url() }}/img/logo_print.jpg" alt="logo Stucher" width="270" height="68">

    <a title="Revenir à la page précédente" class="unlink backButton--logout" href="{!! action( 'CourseController@index' ) !!}"><span class="hidden">Revenir à la page précédente</span><span class="icon-arrow-left"></span></a>

</header>

<ul class="logoutContent">
    <h2>Plan du site</h2>
    <li><a href="{{ action( 'CourseController@index' ) }}">Accueil</a></li>
    <li><a href="{{ action( 'Auth\AuthController@getLogin' ) }}">Page de connexion</a></li>
    <li><a href="{{ action( 'Auth\AuthController@getRegister' ) }}">Page d'inscription</a></li>
    <li><a href="{{ action( 'PageController@useRights' ) }}">Condition d'utilisation</a></li>
    <li><a href="{{ action( 'PageController@planDuSite' ) }}">Plan du site</a></li>
</ul>

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