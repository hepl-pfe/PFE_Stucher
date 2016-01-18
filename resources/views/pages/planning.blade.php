<?php 
use Carbon\Carbon;
use App\Course;
setlocale( LC_ALL, 'fr_FR'); 
?>

@extends('layout')
@section('title', $title)
@section('content')
	<h2>Mon planning&nbsp;:</h2>
	@if( Auth::user()->status == 1 )
		<div class="dropdown text-right">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ajouter
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'CourseController@create' ) !!}">Un cours</a></li>
				<li><a href="{!! action( 'WorkController@create' ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'TestController@create' ) !!}">Une interrogation</a></li>
				<li><a href="{!! action( 'CourseController@addNews' ) !!}">Une notification</a></li>
			</ul>
		</div>
	@endif

	
<?php
    // Basé sur le code de : http://codes-sources.commentcamarche.net/source/42344-calendrier-par-semaine-avec-actions
    
    if(isset($_GET["lundi"])) // Une semaine précise est demandée
    {
        $ts = $_GET["lundi"];
    }
    else //On prendra la semaine d'aujourd'hui
    {
        $day = (date('w') - 1); //Jour dans la semaine... Lundi = 0
        $diff = $day * 86400; //Différence en secondes par rapport au lundi
        $ts = (time() - $diff); //On récupère le TimeStamp du lundi
        //$ts = time();
    }

    //Initialisation des variables
    $week = date('W', $ts); //Semaine en cours
    $avant = $ts - 604800; //TimeStamp Lundi précédant
    $apres = $ts + 604800; //TimeStamp Lundi suivant
    $today = Carbon::now();
    $thisMonday = $today->startOfWeek();
    $noSeance = [];
    //$nextMonday = $thisMonday->addWeek(1);
?>
    <table align="center" border="1" width="420px">
        <tr>
            <td align="center" width="14%"><b>Lun</b></td>
            <td align="center" width="14%"><b>Mar</b></td>
            <td align="center" width="14%"><b>Mer</b></td>
            <td align="center" width="14%"><b>Jeu</b></td>
            <td align="center" width="14%"><b>Ven</b></td>
            <td align="center" width="14%"><b>Sam</b></td>
            <td align="center"><b>Dim</b></td>
        </tr>
        <tr>
            <?php
            for($i=1;$i<8;$i++) //Pour chaque jour de la semaine... Lundi = 1
            {
                $the_date = strval( date('Y-m-d', $ts) );
                if( ($i == date('w')) && ($week == date('W')) ) //Il s'agit d'aujourd'hui!
                {
                    ?>
                    <td align="center" style="background-color:#FFFF00;" onMouseUp="actionDate('<?= date('d M Y', $ts);?>', event)">
                        {{ Carbon::createFromFormat('Y-m-d', $the_date)->formatLocalized('%d %B %Y') }}
                    </td>
                    <?php
                }
                else
                {
                    ?>
                    <td align="center" style="background-color:#FFFFFF;" onMouseUp="actionDate('<?= date('d M Y', $ts);?>', event)">
                        {{ Carbon::createFromFormat('Y-m-d', $the_date)->formatLocalized('%d %B %Y') }}
                    </td>
                    <?
                }
                $ts += 86400; //On passe au jour suivant
            }
            ?>
        </tr>
    </table>
    <div align="center">
        <a href="?lundi=<?= $avant;?>"><<</a>&nbsp;Semaine&nbsp;<?= $week;?>&nbsp;<a href="?lundi=<?= $apres;?>">>></a>
        <br>
        <a href="?lundi=<?= strtotime($thisMonday);?>">Cette semaine</a>
    </div>

    

    <ul class="list-group">
        @foreach ($seances as $seance)
            @foreach ($seance as $the_seance)
                <?php   $start= date_timestamp_get( $the_seance->start_hours );
                        $end= date_timestamp_get( $the_seance->end_hours ); 
                ?>
                <?php $the_week = $the_seance->start_hours->weekOfYear; ?>
                <?php 
                    if( strlen($the_week) === 1 ) {
                        $the_week = '0'.$the_week;
                    }
                ?>
                
                @if ( strval($week) === strval($the_week) )
                    <li class="list-group-item">
                    <?php   $course = Course::findOrFail($the_seance->course_id); 
                            $noSeance[] = '1'; ?>
                    <dt>
                    Séance du {{ $the_seance->start_hours->formatLocalized('%A %d %B %Y') }} à {{ $the_seance->start_hours->formatLocalized('%Hh%M') }} pour le cours de {{ $course->title }}

                    @if ( \Auth::user()->status === 1 )
                        <a class="btn btn-warning" href="{!! action( 'SeanceController@edit', [ "id" => $the_seance->id ] ) !!}">Modifier</a>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $the_seance->id }}">X</button>
                        <div id="{{ $the_seance->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Voulez-vous vraiment supprimer cette séance?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Attention, c'est irréversible!</p>
                                        <p>En supprimant cette séance, vous supprimerez tous les devoirs et interrogations s'y rapportant.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{!! action( 'SeanceController@delete', [ "id" => $the_seance->id, "course_id" => $the_seance->course_id ] ) !!}" class="btn btn-danger">Oui</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


            @endforeach
            
        @endforeach 
        @if ( count($noSeance) === 0 )
            <li>Aucune séance pour cette semaine</li>
        @endif
    </ul>



	{{-- <div id="calendar"></div> --}}
@endsection