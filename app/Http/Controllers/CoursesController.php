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
            $courses = Courses::all();
            $title = 'Tous mes cours';
            return view('courses/indexCourses', compact('courses', 'title'));
        } 
        return view('welcome', ['title' => $title]);
    }

    public function view( $id, $action ) {
        $course = Courses::findOrFail($id);
        $act = $action;
        $title = 'Cours de '.$course->title;
        if ( \Auth::user()->status == 1 ) {
            $title = 'Cours de '.$course->title.' Groupe 3TQ';
            return view('courses/viewCourse', compact('course', 'title', 'act'));
        }
        return view('courses/viewCourse', compact('course', 'title', 'act'));
    }

    public function create() {
        $title = 'Créer un cours';
        return view('courses/createCourse', ['title' => $title]);
    }

    public function store() {
        $course = Courses::create(['title' => Input::get('title')]);
        $title = 'Tous les cours';
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

    public function edit() {

    }

    public function delete() {
        $course = Courses::findOrFail($id);
    }
}
