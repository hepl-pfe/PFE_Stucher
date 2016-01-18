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

    








	{{-- <div id="calendar"></div> --}}
@endsection