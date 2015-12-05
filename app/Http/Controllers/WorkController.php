<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\Seance;
use \Input;
use App\Work;

class WorkController extends Controller
{
    public function create( $id = null, $info = null ) {
        $title = 'Créer un devoir';
        $allCourses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
    	if($id == null) {
            return view('test/createTest', ['title' => $title, 'allCourses' => $allCourses]);
    		die('ok sans information concernant le cours ou la séance');
    	}
    	if($id != null) {
    		 if( $info == 'course' ) {
                $course = Course::findOrFail( $id );
                return view('test/createTest', ['title' => $title, 'allCourses' => $allCourses, 'course' => $course]);
    			die('ok sans information concernant la séance');
    		 }
    		 if( $info == 'seance' ) {
    		 	setlocale( LC_ALL, 'fr_FR');
    		 	$seance = Seance::findOrFail( $id );
		    	$allSeances = Seance::where( 'course_id', '=', $seance->course_id )->get();
		        $course = Course::where( 'id', '=', $seance->course_id )->get();
		        return view('work/createWork', ['title' => $title, 'seance' => $seance, 'course'=> $course, 'allCourses' => $allCourses, 'allSeances' => $allSeances]);
    		 }
    	}
    }

    public function store() {
        $works = Work::create([
            'seance_id' => Input::get('seance'),
            'title' => Input::get('title'),
            //'file' => Input::get('file'),
            'description' => Input::get('descr')
            ]);
        
        return redirect()->route('viewSeance', ['id' => Input::get('seance')]);
    }
}
