<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\Seance;
use App\Work;
use App\Test;
use App\User;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function view() 
    {
        $title = "Planning";
        Carbon::setLocale('fr');
        if (\Auth::user()->status === 1) {
            $courses = Course::where('teacher_id', '=', \Auth::user()->id)->get();
            $seances = [];
            $works = [];
            $tests = [];
            foreach ($courses as $course) {
                $seances[] = $course->seances;
            }

            foreach ($seances as $seance) {
                foreach ($seance as $theSeance) {
                    $works[] = $theSeance->works;
                }
                foreach ($seance as $theSeance) {
                    $tests[] = $theSeance->tests;
                }
            }
        }
        return view('pages/planning', compact( 'title', 'seances', 'works', 'test' ));
    }
}
