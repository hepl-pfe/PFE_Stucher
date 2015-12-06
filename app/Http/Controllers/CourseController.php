<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Seance;
use App\Work;
use App\Test;
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
        $teacher = User::where( 'id', '=', $course->teacher_id )->get();
        $seances = $course->seances;
        $students = Course::find($id)->users;
        $act = $action;
        $title = 'Cours de '.$course->title;
        if ( \Auth::user()->status == 1 ) {
            $title = 'Cours de '.$course->title.' groupe '. $course->group;

            return view('courses/viewCourse', compact('id', 'course', 'title', 'act', 'seances', 'students'));
        }

        return view('courses/viewCourse', compact('course', 'teacher', 'title', 'act', 'seances'));
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
            'access_token' => substr( md5(Carbon::now() ), 0, 6),
            'group' => Input::get('group'),
            'school' => Input::get('school'),
            'place' => Input::get('place'),
            ]);
        
        return redirect()->route('indexCourse');
    }

    public function searchCourse() {
        if ( \Auth::check() && \Auth::user()->status==2 ) {
            $courses = Course::all();
            $title = 'Tous les cours existants';
            $mycourses = User::find(\Auth::user()->id)->courses;

            return view('courses/indexAllCourses', compact('courses', 'title'));
        } 
        return back();
    }

    public function addCourse( $id ) {
        if ( \Auth::check() && \Auth::user()->status==2 ) {
            $student = User::findOrFail(\Auth::user()->id);
            // Ajouter le cours et l'utilisateur à la table course_user
            $student->courses()->attach( $id );
            \DB::table('course_user')
                ->where('user_id', \Auth::user()->id)->where('course_id', $id)
                ->update(array('access' => 1));
            
            return redirect()->route('indexCourse');
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

    public function removeCourse( $id_course ) {
        \DB::table('course_user')
        ->where('user_id', \Auth::user()->id)->where('course_id', $id_course)->delete();

        return redirect()->route('indexCourse');
    }

    
    public function removeStudentFromCourse( $id_course, $id_user ) {
        \DB::table('course_user')
        ->where('user_id', $id_user)->where('course_id', $id_course)->delete();

        return redirect()->route('viewCourse', ['id' => $id_course, 'action' => 1]);
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
