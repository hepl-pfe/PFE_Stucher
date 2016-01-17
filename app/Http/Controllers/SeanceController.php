<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Input;
use Validator;
use App\Course;
use App\Seance;
use App\Work;
use App\Test;
use Carbon\Carbon;

class SeanceController extends Controller
{

    protected $storeRules = [
        'start_date' => 'required|date|after:yesterday',
        'end_date' => 'required|date|after:start_date',
        'start_hours' => 'required|date_format:H:i',
        'end_hours' => 'required|date_format:H:i|after:start_hours'
        ];

    protected $updateRules = [
        'date' => 'required|date',
        'start_hours' => 'required|date_format:H:i',
        'end_hours' => 'required|date_format:H:i|after:start_hours'
        ];

    public function create( $id ) {
        $title = 'Générer des séances';
        $courses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        $days = [
            "monday" => "lundi",
            "tuesday" => "mardi",
            "wednesday" => "mercredi",
            "thursday" => "jeudi",
            "friday" => "vendredi",
            "saturday" => "samedi",
            "sunday" => "dimanche"
        ];
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        return view('seance/createSeance', compact('title', 'id', 'courses', 'days', 'today', 'tomorrow'));
    }

    public function store() {
        $error = Validator::make(Input::all(), $this->storeRules);
        if ($error->fails()) {
            return redirect()->back()->withErrors($error);
        }
        $day = Input::get('date').' '.Input::get('daypicker');
        $start_hours = Input::get('date').' '.Input::get('start_hours');
        $end_hours = Input::get('date').' '.Input::get('end_hours');
        $obj_dateStart = date_create($_POST['start_date']  . ' -1 day');
        $obj_dateEnd = date_create($_POST['end_date']);
        while ($obj_dateStart->format('U') <= $obj_dateEnd->format('U')) {
            $obj_dateStart->modify('next '.$day);
            if ($obj_dateStart->format('U') <= $obj_dateEnd->format('U') && $obj_dateStart >= Carbon::today()) {
                $seance = Seance::create([
                    'course_id' => Input::get('course'),
                    'start_hours' => $obj_dateStart->format('Y-m-d').$start_hours.':00',
                    'end_hours' => $obj_dateEnd->format('Y-m-d').$end_hours.':00'
                ]);
            }
        }

        return redirect()->route('viewCourse', ['id' => Input::get('course'), 'action' => 1]);
    }


    public function edit( $id ) {
        $seance = Seance::findOrFail($id);
        $days = [
            "monday" => "lundi",
            "tuesday" => "mardi",
            "wednesday" => "mercredi",
            "thursday" => "jeudi",
            "friday" => "vendredi",
            "saturday" => "samedi",
            "sunday" => "dimanche"
        ];
        $title = 'Modifier la séance';
        $courses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        $course_id = $seance->course_id;
        $start_day = substr($seance->start_hours, 0, 10);
        $end_day = substr($seance->end_hours, 0, 10);
        $start_hours = substr($seance->start_hours, 11, 5);
        $end_hours = substr($seance->end_hours, 11, 5);
        return view('seance/updateSeance', compact('title', 'seance', 'days', 'id', 'courses', 'course_id', 'start_day', 'end_day', 'start_hours', 'end_hours'));
    }

    public function update( $id ) {
        $error = Validator::make(Input::all(), $this->updateRules);
        if ($error->fails()) {
            return redirect()->back()->withErrors($error);
        }
        $seance = Seance::findOrFail($id);
        $day = Input::get('date');
        $start_hours = Input::get('start_hours');
        $end_hours = Input::get('end_hours');
        $seance->course_id = Input::get('course');
        $seance->start_hours = $day.$start_hours.':00';
        $seance->end_hours = $day.$end_hours.':00';

        $seance->save();
        return redirect()->route('viewCourse', ['id' => Input::get('course'), 'action' => 1]);
    }

    public function view( $id ) {
        setlocale( LC_ALL, 'fr_FR');
        $seance = Seance::findOrFail($id);
        $works = Work::where('seance_id', '=', $id)->get();
        $tests = Test::where('seance_id', '=', $id)->get();
        $title = 'Séance du '.$seance->start_hours->formatLocalized('%A %d %B %Y') . ' de ' . $seance->start_hours->formatLocalized('%Hh%M') . ' à ' . $seance->end_hours->formatLocalized('%Hh%M');
        return view('seance/viewSeance', compact( 'title', 'id', 'seance', 'works', 'tests' ));
    }

    public function getByCourse( $id_course ) {
        return Course::find($id_course)->seances;
    }

    public function delete( $id, $course ) {
        $seance = Seance::findOrFail($id);

        $works = Work::where( 'seance_id', '=', $id )->get();
        foreach ($works as $work) {
            $work->delete();   
        }

        $tests = Test::where( 'seance_id', '=', $id )->get();
        foreach ($tests as $test) {
            $test->delete();   
        }
        $seance->delete();
        return redirect()->route('viewCourse', ['id' => $course, 'action' => 1]);
    }

    public function deleteAll( $course ) {
        $seances = Seance::where( 'course_id', '=', $course )->get();
        foreach ($seances as $seance) {
            $works = Work::where( 'seance_id', '=', $seance->id )->get();
            foreach ($works as $work) {
                $work->delete();   
            }

            $tests = Test::where( 'seance_id', '=', $seance->id )->get();
            foreach ($tests as $test) {
                $test->delete();   
            }

            $seance->delete();   
        }
        return redirect()->route('viewCourse', ['id' => $course, 'action' => 1]);
    }
}
