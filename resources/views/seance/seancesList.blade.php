@extends('layout')
@section('title', $title)
@section('content')

    <div class="blockTitle">
        <h2 class="mainTitle">{{ $title }}</h2>
        <a title="Revenir au cours de {{ $course->title  }}" class="backButton blockTitle__backButton unlink mainColorfont" href="{!! action( 'CourseController@view', [ 'course' => $course->id ] ) !!}"><span class="hidden">Revenir à la page précédente</span><span class="icon-arrow-left"></span></a>
    </div>

    @if (empty($seances))
        <p>Aucune séances n'est passé pour le moment</p>
    @endif
    <div class="box--group">
        <!-- A FEW (3 latest) SEANCES -->
        <div class="box box--demis box--demis--left box--shadow box--seance--course">
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
            {!! $seances->render() !!}
        </div>
                <!-- A FEW (3 latest) SEANCES -->
        <div class="box box--demis box--demis--right box--shadow box--seance--course">
            <a class="box__bottomLink box__bottomLink--dark" href="{{ action( 'SeanceController@seanceHistory', [ 'id' => $course->id ] ) }}">Voir les séances terminées du cours <span class="hidden">de {{ $course->title }}</span></a>
        </div>
    </div>

@endsection