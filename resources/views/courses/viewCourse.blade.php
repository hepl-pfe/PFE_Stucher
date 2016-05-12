<?php 	use Carbon\Carbon;
		$the_user = 'not';

		if (in_array(\Auth::user()->id, $inCourseStudentsId)) {
			$the_user = 'valided';
		}
		elseif (in_array(\Auth::user()->id, $demandedStudentsId)) {
			$the_user = 'demanded';
		}
?>


@extends( 'layout' )
    @section( 'content' )
    @section( 'title', $title )

	<div class="blockTitle">
		<h2 class="mainTitle">Cours de {{ $course->title }}</h2>
		<h3 class="subTitle">Groupe&nbsp;: {{ $course->group }}</h3>
		@if( \Auth::user()->status == 1 )
			<a title="Modifier le cours" href="{!! action( 'CourseController@edit', [ 'id' => $course->id] ) !!}" class="unlink mainColorfont blockTitle--edit">
				<span class="icon-pencil icon icon--edit"></span> <span class="hidden">Modifier le cours</span>
			</a>
		@endif
		<a title="Revenir à la liste des cours" class="backButton blockTitle__backButton unlink mainColorfont" href="{!! action( 'CourseController@index' ) !!}"><span class="hidden">Revenir à la page précédente</span><span class="icon-arrow-left"></span></a>
	</div>

	<!-- information block -->
	@if ( $the_user == "valided" || \Auth::user()->status == '1' )
	<ul class="infoBlock infoBlock--dark @if( Auth::user()->status == 1 ) infoBlock--teacher @endif">
		@if( Auth::user()->status == 1 )
		<li>
			<a href="">
				<span>Code d'accès</span>
				<span title="Ce code permet à vos étudiants de vous retrouver rapidement">{{ $course->access_token }}</span>
			</a>
		</li>
		@endif
		<li>
			<a title="Voir tous les élèves qui suivent le cours" href="{!! action( 'CourseController@indexCourseUsers', [ 'id' => $course->id] ) !!}">
				<span>Nombre d'élèves</span>
				<span>
					@if ( count($inCourseStudents) == 0 )
						0
					@else
						{{ count($inCourseStudents) }}
					@endif
				</span>
			</a>
		</li>
		<li>
			<a title="Voir toutes les séances du cours" href="{{ action('SeanceController@all', [ 'id' => $course->id]) }}">
				<span>Séances restantes</span>
				<span>{{ count($seances) }}&#8239;/&#8239;{{ count($allSeances) }}</span>
			</a>
		</li>
	</ul>
	@endif


	<!-- dd_moreButton -->
	<div class="dd_moreButton">
		<input type="checkbox" id="dd_moreButton">
		<label for="dd_moreButton" class="dd_moreButton--button"><span></span><span></span></label>

		<ul class="dd_moreButton--content">
			@if( Auth::user()->status == 1 )
				<li><a href="{!! action( 'CourseController@edit', [ 'id' => $course->id] ) !!}">Modifier le cours</a></li>
				<li><a href="{!! action( 'CourseController@delete', [ 'id' => $course->id] ) !!}">Supprimer le cours</a></li>
				<li><a href="{!! action( 'CourseController@create' ) !!}">Créer un cours</a></li>
				<li><a href="{!! action( 'WorkController@create', ['id' => $course->id, 'info' => 'course'] ) !!}">Ajouter un devoir</a></li>
				<li><a href="{!! action( 'TestController@create', ['id' => $course->id, 'info' => 'course'] ) !!}">Ajouter une interrogation</a></li>
				<li><a href="{!! action( 'SeanceController@create', ['id' => $id] ) !!}">Ajouter des séances de cours</a></li>
			@else
				<li><a href="{!! action( 'CourseController@removeCourse', [ 'id' => $course->id ] ) !!}">Quitter le cours</a></li>
			@endif
		</ul>
	</div>


	@if( Auth::user()->status == 2 )
		@if ( $the_user != "valided" )
			<h2>Groupe: <a href="">{{ $course->group }}</a></h2>
			<h2>Professeur: <a href="">{{ $teacher[0]->name }}</a></h2>
			<h2>École: <a href="">Collège Saint-Louis Waremme</a></h2>
			<a class="btn btn-warning" href="{!! action( 'CourseController@searchCourse' ) !!}">Retour</a>
			<a class="btn btn-success" href="{!! action( 'CourseController@addCourse', [ 'id' => $course->id ] ) !!}">Ajouter à mes cours</a>
		@endif
	@endif

	@if ( $the_user == "valided" || \Auth::user()->status == '1' )

		<div class="box--group">
			<!-- A FEW (3 latest) SEANCES -->
			<div class="box box--demis box--demis--left box--shadow box--seance--course">
				<div class="box__head">
					<h3 class="box__smallTitle box__smallTitle--left">Prochaines séances</h3>
					@if( Auth::user()->status == 1 )
						<a href="{!! action( 'SeanceController@create', ['id' => $course->id] ) !!}" class="box__button-icon-text box__button-icon-text--right button-icon-text">
							<span class="icon icon-close icon-plus mainColorfont"></span> Ajouter
						</a>
					@endif
					<div class="clear"></div>
				</div>
				<ul class="box__group--list seance__group--list">
				@if ( isset($seances) )
					@if ( count($seances) == 0 )
						<li class="box__empty center">
							Il n’y a aucune séance pour le moment
						</li>
						<p class="center"></p>
					@else
						@foreach( $seances as $seance )
							<li class="box__group--list--list box__seanceCourse">
								<a class="box__seanceDate" href="{!! action( 'SeanceController@view', ['id' => $seance->id] ) !!}">
									<span class="box__seanceDate--day">{{ $seance->start_hours->formatLocalized('%A') }}</span>
									<span class="box__seanceDate--dayNumber">{{ $seance->start_hours->formatLocalized('%d') }}</span>
									<span class="box__seanceDate--month">{{ $seance->start_hours->formatLocalized('%B') }}</span>
									<span class="box__highlight box__seanceDate--hour">{{ $seance->start_hours->formatLocalized('%Hh%M') }}</span>
								</a>
								<div class="box__seanceCourse--info">
									<!-- HOMEWORKS -->
									<a href="{!! action( 'SeanceController@view', ['id' => $seance->id] ) !!}#works" class="box__seanceCourse--homework box__seanceCourse--numbers">
										<span class="icon-briefcase"></span>
										@if( count($seance->works) !== 0 )
											Devoirs&#8239;: {{ count($seance->works) }}
										@else
											Devoirs&#8239;: 0
										@endif
									</a>

									<!-- TESTS -->
									<a href="{!! action( 'SeanceController@view', ['id' => $seance->id] ) !!}#tests" class="box__seanceCourse--test box__seanceCourse--numbers">
										<span class="icon-book-open"></span>
										@if( count($seance->tests) !== 0 )
											Tests&#8239;: {{ count($seance->tests) }}
										@else
											Tests&#8239;: 0
										@endif
									</a>

									<!-- COMMENTS -->
									<a href="{!! action( 'SeanceController@view', ['id' => $seance->id] ) !!}#comments" class="box__seanceCourse--comment box__seanceCourse--numbers">
										<span class="icon-bubbles"></span>
										<?php $theSeanceComment = []; ?>
										@foreach( $comments as $comment )
											@if( $comment->for == $seance->id )
												<?php $theSeanceComment[] = $comment; ?>
											@endif
										@endforeach
										@if( !empty($theSeanceComment) )
											Com&#8239;: {{ count($theSeanceComment) }}
										@else
											Com&#8239;: 0
										@endif
									</a>
								</div>
								<div class="clear"></div>
							</li>
						@endforeach
					@endif
				@else
					<li class="box__group--list--list box__group--studentAsk center">
						Il n’y a aucune séance pour le moment
					</li>
				@endif
				</ul>
				<a class="box__bottomLink box__bottomLink--dark" href="{{ action( 'SeanceController@all', [ 'id' => $course->id ] ) }}">Voir toutes les séances du cours <span class="hidden">de {{ $course->title }}</span></a>
			</div>

			@if ( \Auth::user()->status == '1' )

					<!-- STUDENT IN COURSE -->
			<div class="box box--demis box--demis--right box--shadow box--studentInCourse clear--right">
				<div class="box__head">
					<h3 class="box__bigTitle box__bigTitle--center">
						@if ( count($inCourseStudents) !== 0 )
							{{ count($inCourseStudents) }}
						@else
							Aucun
						@endif
						@if ( count($inCourseStudents) == 1 OR count($demandedStudents) == 0 )
							élève suit le cours
						@else
							élèves suivent le cours
						@endif
					</h3>
					<div class="clear"></div>
				</div>
				<a class="box__bottomLink box__bottomLink--dark" href="{!! action( 'CourseController@indexCourseUsers', [ 'id' => $course->id] ) !!}">Voir tous les élèves qui suivent le cours</a>
			</div>

				<!-- STUDENT ASK -->
				<div class="box box--demis box--demis--right box--shadow box--studentAsk">
					<div class="box__head">
						<h3 class="box__smallTitle box__smallTitle--left">
							@if ( count($demandedStudents) !== 0 )
								{{ count($demandedStudents) }}
							@else
								0
							@endif
							@if ( count($demandedStudents) == 1 )
								élève demande accès au cours
							@else
								élèves demandent accès au cours
							@endif
						</h3>
						<div class="clear"></div>
					</div>
					<ul>
					@if ( count($demandedStudents) !== 0 )
						@foreach ($demandedStudents as $student)
							<li class="box__group--list--list box__group--studentAsk">
								<a class="profilPicName" href="{{ action( 'PageController@viewUser', [ 'id' => $student->id ] ) }}">
									<img class="box__profilImage box__profilImage--small" src="{{ url() }}/img/profilPicture/{{ $student->image }}" alt="Image de profil">
									<span>{{ $student->firstname }} {{$student->name}}</span>
								</a>
								<a class="icon icon-close unlink danger rightBox" href="{!! action( 'CourseController@removeStudentFromCourse', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}"><span class="hidden">Refuser l’accès</span></a>
								<a class="icon icon-check unlink success rightBox" href="{!! action( 'CourseController@acceptStudent', ['id_course' => $course->id, 'id_user' => $student->id] ) !!}"><span class="hidden">Ajouter</span></a>
								<div class="clear"></div>
							</li>
						@endforeach
					@else
						<li class="box__empty center">
							Il n’y a aucun étudiant pour le moment
						</li>
					@endif
					</ul>
					<a class="box__bottomLink box__bottomLink--dark" href="{!! action( 'CourseController@indexWaitingUsers', [ 'id' => $course->id] ) !!}">Voir toutes les demandes d'accès</a>
				</div>

			@endif

		</div>
	@endif()

@stop