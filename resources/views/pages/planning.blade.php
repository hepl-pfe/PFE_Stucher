<?php
use Carbon\Carbon;
use App\Course;
use App\User;
use App\Comment;
setlocale( LC_ALL, 'fr_FR');
?>

@extends('layout')
@section('title', $title)
@section('content')
	<h2 class="mainTitle">Mon planning&nbsp;:</h2>
    <div class="spaceContainer planningPage">

<?php
    // Récuperation des variables passées, on donne soit année; mois; année+mois
    if(!isset($_GET['mois'])) $num_mois = date("n"); else $num_mois = $_GET['mois'];
    if(!isset($_GET['annee'])) $num_an = date("Y"); else $num_an = $_GET['annee'];

    // pour pas s'embeter a les calculer a l'affchage des fleches de navigation...
    if($num_mois < 1) { $num_mois = 12; $num_an = $num_an - 1; }
    elseif($num_mois > 12) {	$num_mois = 1; $num_an = $num_an + 1; }

    // nombre de jours dans le mois et numero du premier jour du mois
    $int_nbj = date("t", mktime(0,0,0,$num_mois,1,$num_an));
    $int_premj = date("w",mktime(0,0,0,$num_mois,1,$num_an));

    // tableau des jours, tableau des mois...
    $tab_jours = array("","Lun","Mar","Mer","Jeu","Ven","Sam","Dim");
    $tab_mois = array("","Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

    $int_nbjAV = date("t", mktime(0,0,0,($num_mois-1<1)?12:$num_mois-1,1,$num_an)); // nb de jours du moi d'avant
    $int_nbjAP = date("t", mktime(0,0,0,($num_mois+1>12)?1:$num_mois+1,1,$num_an)); // b de jours du mois d'apres

    // on affiche les jours du mois et aussi les jours du mois avant/apres, on les indique par une * a l'affichage on modifie l'apparence des chiffres *
    $tab_cal = array(array(),array(),array(),array(),array(),array()); // tab_cal[Semaine][Jour de la semaine]
    $int_premj = ($int_premj == 0)?7:$int_premj;
    $t = 1; $p = "";
    for($i=0;$i<6;$i++) {
        for($j=0;$j<7;$j++) {
            if($j+1 == $int_premj && $t == 1) { $tab_cal[$i][$j] = $t; $t++; } // on stocke le premier jour du mois
            elseif($t > 1 && $t <= $int_nbj) { $tab_cal[$i][$j] = $p.$t; $t++; } // on incremente a chaque fois...
            elseif($t > $int_nbj) { $p="**"; $tab_cal[$i][$j] = $p."1"; $t = 2; } // on a mis tout les numeros de ce mois, on commence a mettre ceux du suivant
            elseif($t == 1) { $tab_cal[$i][$j] = "*".($int_nbjAV-($int_premj-($j+1))+1); } // on a pas encore mis les num du mois, on met ceux de celui d'avant
        }
    }
?>


    <table>
        <tr><td colspan="7" align="center"><a href="?mois=<?php echo $num_mois-1; ?>&amp;annee=<?php echo $num_an; ?>"><<</a>&nbsp;&nbsp;<?php echo $tab_mois[$num_mois];  ?>&nbsp;&nbsp;<a href="?mois=<?php echo $num_mois+1; ?>&amp;annee=<?php echo $num_an; ?>">>></a></td></tr>
        <tr><td colspan="7" align="center"><a href="?mois=<?php echo $num_mois; ?>&amp;annee=<?php echo $num_an-1; ?>"><<</a>&nbsp;&nbsp;<?php echo $num_an;  ?>&nbsp;&nbsp;<a href="?mois=<?php echo $num_mois; ?>&amp;annee=<?php echo $num_an+1; ?>">>></a></td></tr>
        <?php
        echo'<tr>';
        for($i = 1; $i <= 7; $i++){
            echo('<td>'.$tab_jours[$i].'</td>');
        }
        echo'</tr>';

        for($i=0;$i<6;$i++) {
            echo "<tr>";
            for($j=0;$j<7;$j++) {
                //echo $tab_cal[$i][$j]. ' - ';
                $mois_actif = $num_mois;

                if ( (strpos($tab_cal[$i][$j],"*") !== false )) {
                    $mois_actif = $num_mois-1;
                }
                if ( (strpos($tab_cal[$i][$j],"**") !== false )) {
                    $mois_actif = $num_mois+1;
                }

                // Get the activ day
                $actifDay = $tab_cal[$i][$j];
                $actifDayCorrect = str_replace("*","",$tab_cal[$i][$j]);
                $actifMonth = $num_mois;
                $previousMonth = $num_mois-1;
                $nextMonth = $num_mois+1;
                $actifYear = $num_an;
                if( strlen($actifDay) == 1){ $actifDay = '0'.$actifDay; };
                if( strlen($actifDayCorrect) == 1){ $actifDayCorrect = '0'.$actifDayCorrect; };
                if( strlen($actifMonth) == 1){ $actifMonth = '0'.$actifMonth; };
                if( strlen($previousMonth) == 1){ $previousMonth = '0'.$previousMonth; };
                if( strlen($nextMonth) == 1){ $nextMonth = '0'.$nextMonth; };

                $defineActiveDay = '';
                if (($actifYear.'-'.$actifMonth.'-'.$actifDay) == $the_active_day) {
                    $defineActiveDay = 'active_day ';
                }

                $hasASeance = '';
                // Show when there is a seance in the current month
                if ( in_array( ($actifYear.'-'.$actifMonth.'-'.$actifDay), $allSeances ) ) {
                    $hasASeance = 'has_a_seance ';
                }
                if ( ( substr( $actifDay, 0, 1 ) == "*" ) && ( substr( $actifDay, 1, 1 ) != "*" ) ) {
                    // Show when there is a seance in the previous month
                    if ( in_array( ($actifYear.'-'.$previousMonth.'-'.$actifDayCorrect), $allSeances ) ) {
                        $hasASeance = 'has_a_seance ';
                    }
                }
                if ( substr( $actifDay, 0, 2 ) == "**" ) {
                    // Show when there is a seance in the next month
                    if ( in_array( ($actifYear.'-'.$nextMonth.'-'.$actifDayCorrect), $allSeances ) ) {
                        $hasASeance = 'has_a_seance ';
                    }
                }

                $isToday = '';
                if ( $num_mois == date("n") && $num_an == date("Y") && $tab_cal[$i][$j] == date("j") )
                {
                    $isToday = 'today ';
                }


                echo "<td class='$defineActiveDay'>".'<a class="'.$hasASeance.$isToday.'" href="?jour='.str_replace("*","",$tab_cal[$i][$j]).'&mois='.$mois_actif.'&annee='.$num_an.'">'.((strpos($tab_cal[$i][$j],"*")!==false)?'<font color="#aaaaaa">'.str_replace("*","",$tab_cal[$i][$j]).'</font>':$tab_cal[$i][$j])."</a></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    @if( empty( $currentSeances ) )
        <!-- SI AUCUNE SÉANCE -->
        <p>Aucune séance prévue cette journée</p>
    @else
        <ul>
        @foreach( $currentSeances as $seance )
            <li>
                <?php $theCourse = $seance->course; ?>
                Cours de {{ $theCourse->title }}
                <br>
                <span>de {{ $seance->start_hours->formatLocalized('%Hh%M') }} à {{ $seance->end_hours->formatLocalized('%Hh%M') }}</span>
                <br>
                @if ( \Auth::user()->status === 1 )
                    <a class="btn btn-warning" href="{!! action( 'SeanceController@edit', [ "id" => $seance->id ] ) !!}">Modifier</a>
                    <a class="btn btn-warning" href="{!! action( 'SeanceController@delete', [ "id" => $seance->id ] ) !!}">Supprimer</a>
                @endif
                <br>
                <div>
                    @if ( count($seance->works) != 0 )
                        <a href="{!! action( 'SeanceController@view', [ "id" => $seance->id ] ) !!}#works">
                            <span>Devoir&nbsp:</span>
                            {{ count($seance->works) }}
                        </a>
                    @endif
                    @if ( count($seance->tests) != 0 )
                        <a href="{!! action( 'SeanceController@view', [ "id" => $seance->id ] ) !!}#tests">
                            <span>Interrogation&nbsp:</span>
                            {{ count($seance->tests) }}
                        </a>
                    @endif
                    <?php $comments = Comment::where('context', '=', 1)->where('for', $seance->id)->get(); ?>
                    @if ( isset($comments) )
                        @if ( count($comments) != 0 )
                            <a href="{!! action( 'SeanceController@view', [ "id" => $seance->id ] ) !!}#comments">
                                <span>Commentaires&nbsp;:</span>
                                {{ count($comments) }}
                            </a>
                        @endif

                    @endif
                </div>
            </li>
                <br>
        @endforeach
        </ul>
    @endif


@endsection
