<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Input;
use App\Course;
use App\Seance;
use Carbon\Carbon;

class SeanceController extends Controller
{
    public function create( $id ) {
        $title = 'Créer une séance';
        $courses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        return view('seance/createSeance', ['title' => $title, 'id' => $id, 'courses'=> $courses]);
    }

    public function store() {
        $day = Input::get('date').' '.Input::get('daypicker');
        $start_hours = Input::get('date').' '.Input::get('start_hours');
        $end_hours = Input::get('date').' '.Input::get('end_hours');
        $dayFr = [ "monday" => "lundi",
                   "tuesday" => "mardi", 
                   "wednesday" => "mercredi", 
                   "thursday" => "jeudi", 
                   "friday" => "vendredi", 
                   "saturday" => "samedi", 
                   "sunday" => "dimanche" ];

        $obj_dateStart = date_create($_POST['start_date']  . ' -1 day');
        $obj_dateEnd = date_create($_POST['end_date']);
        while ($obj_dateStart->format('U') <= $obj_dateEnd->format('U')) {
            $obj_dateStart->modify('next '.$day);
            if ($obj_dateStart->format('U') <= $obj_dateEnd->format('U') && $obj_dateStart >= Carbon::today()) {
                //echo 'ce '.$dayFr[ $day ]." " . $obj_dateStart->format('d-m-Y') .'<br/>';
                //echo $obj_dateStart->format('d-m-Y') .'<br/>';
                $seance = Seance::create([
                    'course_id' => Input::get('course'),
                    'start_hours' => $obj_dateStart->format('Y-m-d').$start_hours.':00',
                    'end_hours' => $obj_dateEnd->format('Y-m-d').$end_hours.':00'
                ]);
            }
        }

        return redirect()->back();
    }

    public function view( $id ) {
        setlocale( LC_ALL, 'fr_FR');
        $seance = Seance::findOrFail($id);
        $title = 'Séance du '.$seance->start_hours->formatLocalized('%A %d %B %Y') . ' de ' . $seance->start_hours->formatLocalized('%Hh%M') . ' à ' . $seance->end_hours->formatLocalized('%Hh%M');
        return view('seance/viewSeance', ['title' => $title, 'id' => $id, 'seance' => $seance]);
    }
}
