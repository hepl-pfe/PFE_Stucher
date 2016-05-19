@extends( 'layout' )
@section( 'content' )
@section( 'title', $title )

<div class="blockTitle">
	<h2 class="mainTitle">{{ $title }}</h2>
</div>

@if ( count($students) !== 0 )
	<div class="box--group">
		<div class="box box--shadow box--studentAll">
			<ul>
				@foreach ($students as $student)
					<li class="box__group--list--list box__group--studentAsk">
						<a class="profilPicName" href="{{ action( 'PageController@viewUser', [ 'id' => $student[0]->id ] ) }}">
							<img class="box__profilImage box__profilImage--small" src="{{ url() }}/img/profilPicture/{{ $student[0]->image }}" alt="Image de profil">
							<span>{{ $student[0]->firstname }} {{$student[0]->name}}</span>
						</a>
						<a class="unlink box__list__rightButton" href="mailto:{{ $student[0]->email }}">Contacter</a>
						<div class="clear"></div>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@else
	<p class="item--null">
		Il n’y a aucun étudiant pour le moment
	</p>
@endif


@stop