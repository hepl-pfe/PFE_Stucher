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
        $start_hours = Input::get('date').' '.Input::get('start_hours').':00';
        $end_hours = Input::get('date').' '.Input::get('end_hours').':00';
        $seance = Seance::create([
            'course_id' => Input::get('course'),
            'start_hours' => $start_hours,
            'end_hours' => $end_hours
            ]);
        return redirect()->back();
    }

    public function view( $id ) {
        setlocale( LC_ALL, 'fr_FR');
        $seance = Seance::findOrFail($id);
        $title = 'Séance du '.$seance->start_hours->formatLocalized('%A %d %B %Y') . ' de ' . $seance->start_hours->formatLocalized('%Hh%M') . ' à ' . $seance->end_hours->formatLocalized('%Hh%M');
        return view('seance/viewSeance', ['title' => $title, 'id' => $id, 'seance' => $seance]);
    }
}
