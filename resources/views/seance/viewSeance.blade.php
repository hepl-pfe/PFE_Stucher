<?php use Carbon\Carbon;
Carbon::setLocale('fr'); ?>
<?php use App\User; ?>

@extends( 'layout' )
    @section( 'content' )
    @section( 'title', $title )
	<h2 class="pageTitle">Séance de cours</h2>
	<div class="spaceContainer">
		<a class="btn btn-warning" href="{!! action( 'CourseController@view', [ "id" => $seance->course_id ] ) !!}"><—</a>

		@if ( \Auth::user()->status == 1 )
			<a class="btn btn-primary" href="{!! action( 'SeanceController@edit', [ "id" => $seance->id ] ) !!}">Modifier la séance</a>
			<a class="btn btn-primary" href="{!! action( 'SeanceController@delete', [ "id" => $seance->id, "course_id" => $seance->course_id ] ) !!}">Supprimer la séance</a>

			<!-- Dropdown menu -->
			<div class="mainDropdown">
				<button class="btn-add" type="button" data-toggle="dropdown">
				<span class="caret">Ajouter</span></button>
				<ul class="mainDropdown-menu">
					<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
					<li><a href="{!! action( 'WorkController@create', ['id' => $seance->id, 'info' => 'seance'] ) !!}">Un devoir</a></li>
					<li><a href="{!! action( 'TestController@create', ['id' => $seance->id, 'info' => 'seance'] ) !!}">Une interrogation</a></li>
				</ul>
			</div>
		@endif

		<br><br>
		<div class="panel-group">
			<div class="row">
				<div class="panel-primary">
		      		<div class="panel-heading titleSpace">Informations sur la séances:</div>
		      		<div class="panel-body">
		      			<p><span>Jour : </span>{{ $seance->start_hours->formatLocalized('%A %d %B %Y') }}</p>
		      			<p><span>Heure : </span>de {{ $seance->start_hours->formatLocalized('%Hh%M') }} à {{ $seance->end_hours->formatLocalized('%Hh%M') }}</p>
		      		</div>
		      	</div>
		      	@if ( isset($tests) )
				    @if ( count($tests) == 0 )
					@else
				      	<div class="panel-warning">
				      		<div class="panel-heading titleSpace">Interrogation:</div>
				      		<ul class="panel-body list-group">
								@foreach ($tests as $test)
									<li class="list-group-item">
										<h3>{{$test->title}}

										@if ( \Auth::user()->status == 1 )
											<a class="btn btn-primary" href="{!! action( 'TestController@delete', ['id' => $test->id] ) !!}">Supprimer</a>

											<a href="{{ action( 'TestController@edit', ['id' => $test->id] ) }}" class="btn badge btn-warning pull-right">modifier</a>
										@endif

										 </h3>
										<p>
											{{$test->description}}
										</p>

									</li>
								@endforeach
				      		</ul>
				      	</div>
			      	@endif
			    @endif
			    @if ( isset($works) )
				    @if ( count($works) == 0 )
					@else
				      	<div class="panel-warning">
				      		<div class="panel-heading titleSpace">Devoirs:</div>
				      		<ul class="panel-body list-group">
								@foreach ($works as $work)
									<li class="list-group-item">
										<h3>{{$work->title}}

										@if ( \Auth::user()->status == 1 )
											<a class="btn btn-primary" href="{!! action( 'WorkController@delete', ['id' => $work->id] ) !!}">Supprimer</a>


											<a href="{{ action( 'WorkController@edit', ['id' => $work->id] ) }}" class="btn badge btn-warning pull-right">modifier</a>
										@endif

										</h3>

										<p>
											{{$work->description}}
										</p>
									</li>
								@endforeach
				      		</ul>
				      	</div>
				    @endif
				@endif
	      	</div>
	    </div>
		<div class="comments">
			@if ( isset($comments) )
				@if ( count($comments) == 0 )
				@else
					<ul class="comments--list">
					@foreach ($comments as $comment)
						<li>
							<?php $user=User::findOrFail($comment->from); ?>
							<a href="{!! action( 'PageController@viewUser', ['id' => $user->id] ) !!}">
								<img src="{{ url() }}/img/profilPicture/{{ $user->image }}" alt="Image de profil">
								{{ $user->firstname }} {{ $user->name }}
							</a>
							<?= $comment->body; ?>
							<span class="time"><?= $comment->created_at->diffForHumans(); ?></span>
							@if( \Auth::user()->status == 1 )
									<a href="{!! action( 'CommentController@delete', ['id' => $comment->id] ) !!}">Supprimer</a>
							@endif
						</li>
					@endforeach
					</ul>
				@endif

			@endif
			<form method="POST" action="/comments/create">
				{!! csrf_field() !!}

				<div class="form-group">
					<label for="comment">Votre commentaire</label>
					<textarea name="comment" id="comment"></textarea>
					<input type="hidden" name="context" value="1">
					<input type="hidden" name="for" value="<?= $seance->id; ?>">
					<!-- /!\ Afficher les erreurs -->
				</div>

				<div class="form-group">
					<button class="btn btn-default" type="submit">Envoyer</button>
				</div>

			</form>
		</div>
	</div>
@stop