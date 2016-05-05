@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
    <div class="blockTitle">
        <h2 class="mainTitle">{{ $title }}</h2>
    </div>
	<form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course">Pour quel cours?</label>
            <select class="form-control" name="course" id="course">
            
            @foreach ($allCourses as $singleCourse)
                <option value="{{ $singleCourse->id }}" 
                @if( isset( $course ) )
                    @if( isset( $seance ) )
                        <?php $courseId = $course[0]->id; ?>
                    @else
                        <?php $courseId = $course->id; ?>
                    @endif
                    <?php $singleCourseId = $singleCourse->id; ?>
                        @if( $singleCourseId == $courseId )
                            selected="selected"
                        @endif                    
                @endif 
                >{{ $singleCourse->title }} groupe {{ $singleCourse->group }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="seance">Pour quel séance de cours?</label>
            <select class="form-control" name="seance" id="seance">
                @foreach ($allSeances as $singleSeance)
                    <option value="{{ $singleSeance->id }}" 
                    @if ( isset( $seance ) )
                        <?php $singleSeanceId = $singleSeance->id;
                          $seanceId = $seance->id; ?>
                        @if( $singleSeanceId == $seanceId )
                    selected="selected" 
                    @endif @endif >Séance du {{ $singleSeance->start_hours->formatLocalized('%A %d %B %Y') }} de {{ $singleSeance->start_hours->formatLocalized('%Hh%M') }} à {{ $singleSeance->end_hours->formatLocalized('%Hh%M') }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="title">Ajouter le titre à l'interrogation</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="ex: test de propabilité" value="{{ $test->title }}">
        </div>

		<div class="form-group">
			<label for="descr">Description de l'interrogation</label>
			<textarea class="form-control" name="descr" id="descr" cols="30" rows="10" placeholder="ex: La matière de cette interrogation portera sur…">{{$test->description}}</textarea>
		</div>
		<div class="form-group">
            @if( count( $test->files ) != 0 )
                <ul class="box__group--files">
                    @foreach( $test->files as $file )
                        <li class="box__list--files">
                            <a class="box__link--files unlink" download="proposed_file_name" href="{{ url() }}/files/{{ $file->filename }}">{{ $file->title }}</a>
                            <a href="{{ action( 'TestController@deleteFile', ['id_file' => $file->id, 'test_id' => $test->id] ) }}" class="unlink danger"><span class="hidden">Supprimer ce fichier</span><span class="icon-close"></span></a>
                        </li>
                    @endforeach
                        <li class="box__list--files">
                            <label for="file"><span class="hidden">Ajouter un fichier</span><span class="icon-plus success"></span></label>
                            <input class="hidden" type="file" id="file" name="file[]" multiple>
                        </li>
                </ul>
            @else
                <ul class="box__group--files">
                    <li class="box__list--files">
                        <label for="file"><span class="hidden">Ajouter un fichier</span><span class="icon-plus success"></span></label>
                        <input class="hidden" type="file" id="file" name="file[]" multiple>
                    </li>
                </ul>
            @endif
		</div>
		<div class="form-group text-center">
            @if (isset( $seance ))
                <a class="btn btn-warning" href="{!! action( 'SeanceController@view', ['id' => $seance->id] ) !!}">Annuler</a>
            @elseif ( isset( $course ) )
                <a class="btn btn-warning" href="{!! action( 'CourseController@view', ['id' => $course->id, 'status' => 1] ) !!}">Annuler</a>
            @else
                <a class="btn btn-warning" href="{!! URL::previous() !!}">Annuler</a>
            @endif
			<input type="submit" class="btn btn-primary" value="Valider l'interrogation">
		</div>
        @include( 'errors.profilError' )
	</form>
@stop