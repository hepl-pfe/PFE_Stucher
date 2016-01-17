@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
    <h2><?php echo $title; ?></h2>
    <br>
    <a class="btn btn-success" href="">Récupérer un modèle existant</a>
    <br>
    <br>
	<form action="" method="post">
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
            <input type="text" class="form-control" name="title" id="title" placeholder="ex: test de propabilité">
        </div>

		<div class="form-group">
			<label for="descr">Description de l'interrogation</label>
			<textarea class="form-control" name="descr" id="descr" cols="30" rows="10" placeholder="ex: La matière de cette interrogation portera sur…"></textarea>
		</div>
		<div class="form-group">
			<label for="file">Fichier joins (facultatif - PDF, image ou Word)</label>
			<input type="file" id="file" name="file">
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