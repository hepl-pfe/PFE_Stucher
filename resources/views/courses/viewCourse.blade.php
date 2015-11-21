@extends( 'layout' )
    @section( 'content' )
    @section( 'title', $title )

	<h1>{{$title}}</h1>
	@if( Auth::user()->status == 1 )
		<div class="dropdown text-right">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ajouter
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'CoursesController@create' ) !!}">Un cours</a></li>
				<li><a href="{!! action( 'CoursesController@addWork' ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'CoursesController@addTest' ) !!}">Une interrogation</a></li>
				<li><a href="{!! action( 'CoursesController@addNews' ) !!}">Une notification</a></li>
			</ul>
		</div>
		<a class="btn btn-warning" href="">Modifier ce cours</a>
		<a class="btn btn-danger" href="">Supprimer ce cours</a>
	@elseif( Auth::user()->status == 2 )
		@if ( $act == 1 )
			<a class="btn btn-danger" href="">Quitter ce cours</a>
		@else
			<h2>Groupe: <a href="">2e Sciences économie</a></h2>
			<h2>Professeur: <a href="">Cyril Bertrand</a></h2>
			<h2>École: <a href="">Collège Saint-Louis Waremme</a></h2>
			<a class="btn btn-primary" href="">Ajouter à mes cours</a>
		@endif
	@endif

	@if ( $act == 1 )

		<div class="panel-group">
			<br>
			<div class="row">
				<div class="panel-primary">
		      		<div class="panel-heading">Horraire du cours</div>
		      		<div class="panel-body">Le lundi de 10h à 12h <br>Le mardi de 8h à 11h <br>Le jeudi de 13h à 15h</div>
		    	</div>
		    	<div class="panel-warning">
		      		<div class="panel-heading">Journal du cours</div>
		      		<ul class="panel-body">
		      			<li>Devoir: Faire …</li>
		      		</ul>
		    	</div>
				<div class="panel-danger">
		      		<div class="panel-heading">Actions rapide</div>
		      		<div class="panel-body">
		      			
		      		</div>
		    	</div>
		    	@if( Auth::user()->status == 1 )
				<div class="panel-primary">
		      		<div class="panel-heading">Élèves qui suivent le cours</div>
		      		<ul class="panel-body">
		      			<li><a href="">Loïc Parent</a></li>
		      			<li><a href="">Dan Neujean</a></li>
		      			<li><a href="">Frédérique Deval</a></li>
		      			<li><a href="">Hélène Jean</a></li>
		      		</ul>
		    	</div>
		    	<div class="panel-danger">
		      		<div class="panel-heading">Élèves qui demande à suivre le cours</div>
		      		<div class="panel-body">
		      			<li><a href="">Émillie Gérard</a> <a class="btn btn-primary" href="">Ajouter</a> <a class="btn btn-danger" href="">Refuser l’accès</a></li>
		      			<li><a href="">Kévin delois</a> <a class="btn btn-primary" href="">Ajouter</a> <a class="btn btn-danger" href="">Refuser l’accès</a></li>
		      		</div>
		    	</div>
		    	@endif()
			</div>
		</div>
	@endif()
@stop