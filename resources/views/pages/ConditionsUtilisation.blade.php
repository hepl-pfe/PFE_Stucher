@section('title', $title)
@include( 'header' )
<body class="default logOutPages">

<header class="simpleHeader">

    <a class="simpleHeader__logo" href="{!! action( 'CourseController@index' ) !!}">
        <h1>Stucher</h1>
    </a>

    <a title="Revenir à la page précédente" class="unlink backButton--logout" href="{!! action( 'CourseController@index' ) !!}"><span class="hidden">Revenir à la page précédente</span><span class="icon-arrow-left"></span></a>

</header>

<div class="logoutContent">
    <h2>Conditions d'utilisation</h2>
    <h3>Utilisation des données</h3>
    <p>Stucher n’utilise en aucun cas vos données pour d’autres raisons que celle du site. En outre, vous avez la possibilité de modifier ou supprimer les informations que vous donnez au site et de vous désinscrire à tout moment. Pour plus d’information, veuillez vous adresser à
        <a class="unlink" href="mailto:contact@stucher.be">contact@stucher.be</a>
    </p>
    <h3>Responsabilité</h3>
    <p>L'utilisateur se tient pour seul responsable de l'utilisation qu'il fait de l'application. Stucher ne peut être tenus responsable d'éventuelles dégât occasion par l'utilisation de cette application qu'il soit causé par une forme de hacking ou tout autre dysfonctionnement.</p>
    <h3>Illustrations</h3>
    <p>Le site utilise des images libres de droits obtenues sur Internet ou des images que l'utilisateur décide d'ajouter au site. De ce fait, le site n'est pas responsable des choix opéré par ses utilisateurs concernant le droit d'image.</p>
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