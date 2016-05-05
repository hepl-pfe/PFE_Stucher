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
use App\Comment;
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
        $activePage = 'course';
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
        return view('seance/createSeance', compact('title', 'id', 'courses', 'days', 'today', 'tomorrow', 'activePage'));
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
        $activePage = 'course';
        $courses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        $course_id = $seance->course_id;
        $start_day = substr($seance->start_hours, 0, 10);
        $end_day = substr($seance->end_hours, 0, 10);
        $start_hours = substr($seance->start_hours, 11, 5);
        $end_hours = substr($seance->end_hours, 11, 5);
        return view('seance/updateSeance', compact('title', 'seance', 'days', 'id', 'courses', 'course_id', 'start_day', 'end_day', 'start_hours', 'end_hours', 'activePage'));
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

        $datetime1 = new Carbon( $seance->start_hours );
        $datetime2 = new Carbon($seance->end_hours);
        $interval = $datetime1->diff($datetime2);

        $comments = Comment::where('context', '=', 1)->where('for', $id)->get();
        $title = 'Séance du '.$seance->start_hours->formatLocalized('%A %d %B %Y') . ' de ' . $seance->start_hours->formatLocalized('%Hh%M') . ' à ' . $seance->end_hours->formatLocalized('%Hh%M');
        $activePage = 'course';
        return view('seance/viewSeance', compact( 'title', 'id', 'seance', 'interval', 'works', 'tests', 'comments', 'activePage' ));
    }

    public function getByCourse( $id_course ) {
        return Course::find($id_course)->seances;
    }

    public function delete( $id ) {
        $seance = Seance::findOrFail($id);
        $course = Course::findOrFail($seance->course_id);

        $works = Work::where( 'seance_id', '=', $id )->get();
        foreach ($works as $work) {
            $work->delete();   
        }

        $tests = Test::where( 'seance_id', '=', $id )->get();
        foreach ($tests as $test) {
            $test->delete();   
        }
        $seance->delete();
        return redirect()->route('viewCourse', ['id' => $course->id, 'action' => 1]);
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

    public function seanceHistory( $id ) 
    {
        $seances = Seance::where( 'course_id', '=', $id )->get();
        $pastSeances = [];
        $title = "Les séances terminées";
        $activePage = 'course';
        setlocale( LC_ALL, 'fr_FR');
        foreach ($seances as $seance) {
            $now = Carbon::now();
            $endOfSession = Carbon::createFromFormat('Y-m-d H:i:s', $seance->end_hours);
            if ( $endOfSession > $now ) {
                $pastSeances[] = $seance;
            }
        }

        return view('seance/seancesHistory', compact( 'title', 'pastSeances', 'activePage'));
    }
}
