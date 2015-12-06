<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\Seance;
use \Input;
use App\Test;
use Carbon\Carbon;

class TestController extends Controller
{
    public function create( $id = null, $info = null ) {
        setlocale( LC_ALL, 'fr_FR');
    	$title = 'Créer une interrogation';
    	$allCourses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        if( $allCourses->first() == null ) {
            return redirect()->back();
        }
    	if($id == null) {
            $firstCourse = $allCourses->first();
            $allSeances = Seance::where( 'course_id', '=', $firstCourse->id )->get();
    		return view('test/createTest', ['title' => $title, 'allCourses' => $allCourses, 'allSeances' => $allSeances]);
    	}
    	if($id != null) {

    		 if( $info == 'course' ) {
    		 	$course = Course::findOrFail( $id );
                $allSeances = Seance::where( 'course_id', '=', $id )->get();
    		 	return view('test/createTest', ['title' => $title, 'allCourses' => $allCourses, 'allSeances' => $allSeances, 'course' => $course]);
    		 }
    		 if( $info == 'seance' ) {
    		 	$seance = Seance::findOrFail( $id );
		    	$allSeances = Seance::where( 'course_id', '=', $seance->course_id )->get();
		        $course = Course::where( 'id', '=', $seance->course_id )->get();
		        return view('test/createTest', ['title' => $title, 'seance' => $seance, 'course'=> $course, 'allCourses' => $allCourses, 'allSeances' => $allSeances]);
    		 }
    	}
    }

    public function edit( $id ) {
        $test = Test::findOrFail( $id );
        $pageTitle = 'Modifier l’interrogation';
        $allCourses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        $course = Seance::find($test->seance_id)->course;
        $allSeances = Seance::where( 'course_id', '=', $course->id )->get();
        return view('test/updateTest', compact('pageTitle', 'test', 'allSeances', 'allCourses'));
    }
    public function store() {
        $works = Test::create([
            'seance_id' => Input::get('seance'),
            'title' => Input::get('title'),
            //'file' => Input::get('file'),
            'description' => Input::get('descr')
            ]);
        
        return redirect()->route('viewSeance', ['id' => Input::get('seance')]);
    }
}
