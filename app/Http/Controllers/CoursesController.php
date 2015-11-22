<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;
use \Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    public function index() {
        $title = 'Accueil';
        if ( \Auth::check() ) {
            $title = 'Tous mes cours';
            if ( \Auth::user()->status === 1 ) {
                //$courses = Courses::all();
                $courses = Courses::where( 'teacher_id', '=', \Auth::user()->id )->get();
                return view('courses/indexTeacherCourses', compact('courses', 'title'));
            }
            return view('courses/indexStudentCourses', compact('courses', 'title'));
        } 
        return view('welcome', ['title' => $title]);
    }

    public function view( $id, $action ) {
        $course = Courses::findOrFail($id);
        $act = $action;
        $title = 'Cours de '.$course->title;
        if ( \Auth::user()->status == 1 ) {
            $title = 'Cours de '.$course->title.' groupe '. $course->group;
            return view('courses/viewCourse', compact('course', 'title', 'act'));
        }
        return view('courses/viewCourse', compact('course', 'title', 'act'));
    }

    public function create() {
        $title = 'Créer un cours';
        return view('courses/createCourse', ['title' => $title]);
    }

    public function store() {
        $course = Courses::create([
            'title' => Input::get('title'),
            'teacher_id' => \Auth::user()->id,
            'group' => Input::get('group'),
            'school' => Input::get('school'),
            'place' => Input::get('place'),
            ]);
        return redirect()->route('indexCourses');
    }

    public function add() {
        if ( \Auth::check() && \Auth::user()->status==2 ) {
            $courses = Courses::all();
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
        $course = Courses::findOrFail($id);
        $pageTitle = 'Modifier le cours';
        $id = $course->id;
        $title = $course->title;
        $group = $course->group;
        $school = $course->school;
        $place = $course->place;
        return view('courses/updateCourse', compact('pageTitle', 'id', 'title', 'group', 'school', 'place'));
    }

    public function update( $id ) {
        $course = Courses::findOrFail($id);
        $course->title = Input::get('title');
        $course->group = Input::get('group');
        $course->school = Input::get('school');
        $course->place = Input::get('place');
        $course->updated_at = date( 'Y-m-d H:i:s' );
        $course->save();
        return redirect()->route('indexCourses');
    }

    public function delete( $id ) {
        $course = Courses::findOrFail($id);
        $course->delete();
        return redirect()->route('indexCourses');
    }
}
