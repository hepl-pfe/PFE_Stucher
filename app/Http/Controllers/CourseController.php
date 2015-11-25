<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Seance;
use \Input;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{

    public function index() {
        $title = 'Accueil';
        if ( \Auth::check() ) {
            $title = 'Tous mes cours';
            if ( \Auth::user()->status === 1 ) {
                $courses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
                return view('courses/indexTeacherCourses', compact('courses', 'title'));
            }
            return view('courses/indexStudentCourses', compact('courses', 'title'));
        } 
        return view('welcome', ['title' => $title]);
    }

    public function view( $id, $action ) {
        setlocale( LC_ALL, 'fr_FR');
        $course = Course::findOrFail($id);
        $seances = Seance::where( 'course_id', '=', $id )->get();
        $act = $action;
        $title = 'Cours de '.$course->title;
        if ( \Auth::user()->status == 1 ) {
            $title = 'Cours de '.$course->title.' groupe '. $course->group;
            return view('courses/viewCourse', compact('id', 'course', 'title', 'act', 'seances'));
        }
        return view('courses/viewCourse', compact('course', 'title', 'act'));
    }

    public function create() {
        $title = 'Créer un cours';
        return view('courses/createCourse', ['title' => $title]);
    }

    public function store() {
        $courses = Course::all();
        $course = Course::create([
            'title' => Input::get('title'),
            'teacher_id' => \Auth::user()->id,
            'access_token' => substr( md5(Carbon::now() ), 0, 8),
            'group' => Input::get('group'),
            'school' => Input::get('school'),
            'place' => Input::get('place'),
            ]);
        return redirect()->route('indexCourse');
    }

    public function add() {
        if ( \Auth::check() && \Auth::user()->status==2 ) {
            $courses = Course::all();
            $title = 'Tous les cours existants';
            return view('courses/addCourses', compact('courses', 'title'));
        } 
        return back();
    }

    public function addWork() {
        if ( \Auth::check() && \Auth::user()->status==1 ) {
            $title = 'Ajouter un devoir';
            return view('courses/addWork', compact('title'));
        } 
        return back();
    }

    public function addTest() {
        if ( \Auth::check() && \Auth::user()->status==1 ) {
            $title = 'Ajouter une interrogation';
            return view('courses/addTest', compact('title'));
        } 
        return back();
    }

    public function addNews() {
        if ( \Auth::check() && \Auth::user()->status==1 ) {
            $title = 'Ajouter une notification';
            return view('courses/addNews', compact('title'));
        } 
        return back();
    }

    public function remove() {

    }

    public function edit( $id ) {
        $course = Course::findOrFail($id);
        $pageTitle = 'Modifier le cours';
        $id = $course->id;
        $title = $course->title;
        $group = $course->group;
        $school = $course->school;
        $place = $course->place;
        return view('courses/updateCourse', compact('pageTitle', 'id', 'title', 'group', 'school', 'place'));
    }

    public function update( $id ) {
        $course = Course::findOrFail($id);
        $course->title = Input::get('title');
        $course->group = Input::get('group');
        $course->school = Input::get('school');
        $course->place = Input::get('place');
        $course->updated_at = Carbon::now();
        $course->save();
        return redirect()->route('indexCourse');
    }

    public function delete( $id ) {
        $course = Course::findOrFail($id);
        $seances = Seance::where( 'course_id', '=', $course->id )->get();;
        foreach ($seances as $seance) {
            $seance->delete();   
        }
        $course->delete();
        return redirect()->route('indexCourse');
    }
}
