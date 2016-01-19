<?php 
use Carbon\Carbon;
use App\Course;
setlocale( LC_ALL, 'fr_FR'); 
?>

@extends('layout')
@section('title', $title)
@section('content')
	<h2 class="pageTitle">Mon planning&nbsp;:</h2>
    <div class="spaceContainer planningPage">

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

    <div class="planning__controller" align="center">
        <a class="planning__controller--control" href="?lundi=<?= $avant;?>"><<</a>&nbsp;Semaine&nbsp;<?= $week;?>&nbsp;<a class="planning__controller--control planning__controller--control--2" href="?lundi=<?= $apres;?>">>></a>
        <a class="planning__controller--thisWeek" href="?lundi=<?= strtotime($thisMonday);?>">Cette semaine</a>
    </div>

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
                    <li class="plannine__list-group-item">
                    <?php   $course = Course::findOrFail($the_seance->course_id); 
                            $noSeance[] = '1'; ?>
                    <dt>
                    Séance du {{ $the_seance->start_hours->formatLocalized('%A %d %B %Y') }} à {{ $the_seance->start_hours->formatLocalized('%Hh%M') }} pour le cours de {{ $course->title }}

                    @if ( \Auth::user()->status === 1 )
                        <a class="btn btn-warning" href="{!! action( 'SeanceController@edit', [ "id" => $the_seance->id ] ) !!}">Modifier</a>
                        <a class="btn btn-warning" href="{!! action( 'SeanceController@delete', [ "id" => $the_seance->id, "course_id" => $the_seance->course_id ] ) !!}">Supprimer</a>
                    @endif

                    </dt>
                    <br>
                    @if ( count($the_seance->works) != 0 )
                        <dt>Devoir:</dt>
                        @foreach ($the_seance->works as $work)
                            <dd>{{ $work->title }}</dd>
                            <dd>{{ $work->description }}</dd>
                        @endforeach
                    @endif
                    @if ( count($the_seance->tests) != 0 )
                        <dt>Interrogation:</dt>
                        @foreach ($the_seance->tests as $test)
                            <dd>{{ $test->description }}</dd>
                        @endforeach
                    @endif
                </li>
                @endif

            @endforeach
            
        @endforeach 
        @if ( count($noSeance) === 0 )
            <li class="center">Aucune séance pour cette semaine</li>
        @endif
    </ul>

{{-- <div id="calendar"></div> --}}    

</div>

@endsection