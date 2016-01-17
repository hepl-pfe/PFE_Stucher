<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Course;
use App\Seance;
use \Input;
use App\Work;
use Carbon\Carbon;

class WorkController extends Controller
{

    protected $rules = [
        'course' => 'required',
        'seance' => 'required',
        'title' => 'required|max:255',
        'descr' => 'required'
        //'file' => 'required|date_format:H:i|after:start_hours'
        ];

    public function create( $id = null, $info = null ) {
        setlocale( LC_ALL, 'fr_FR');
        $title = 'Créer un devoir';
        $allCourses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        if( $allCourses->first() == null ) {
            return redirect()->back();
        }
        if($id == null) {
            $firstCourse = $allCourses->first();
            $allSeances = Seance::where( 'course_id', '=', $firstCourse->id )->get();
            return view('work/createWork', ['title' => $title, 'allCourses' => $allCourses, 'allSeances' => $allSeances]);
        }
        if($id != null) {

             if( $info == 'course' ) {
                $course = Course::findOrFail( $id );
                $allSeances = Seance::where( 'course_id', '=', $id )->get();
                return view('work/createWork', ['title' => $title, 'allCourses' => $allCourses, 'allSeances' => $allSeances, 'course' => $course]);
             }
             if( $info == 'seance' ) {
                $seance = Seance::findOrFail( $id );
                $allSeances = Seance::where( 'course_id', '=', $seance->course_id )->get();
                $course = Course::where( 'id', '=', $seance->course_id )->get();
                return view('work/createWork', ['title' => $title, 'seance' => $seance, 'course'=> $course, 'allCourses' => $allCourses, 'allSeances' => $allSeances]);
             }
        }
    }

    public function edit( $id ) {
        setlocale( LC_ALL, 'fr_FR');
        $work = Work::findOrFail( $id );
        $pageTitle = 'Modifier le devoir';
        $allCourses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        $course = Seance::find($work->seance_id)->course;
        $allSeances = Seance::where( 'course_id', '=', $course->id )->get();
        return view('work/updateWork', compact('pageTitle', 'work', 'allSeances', 'allCourses'));
    }

    public function update( $id ) {
        $errors = Validator::make(Input::all(), $this->rules);
        if ($errors->fails()) {
            return Redirect()->back()->withErrors($errors);
        }
        $work = Work::findOrFail($id);
        $work->title = Input::get('title');
        $work->description = Input::get('descr');
        //$work->file = Input::get('file');
        $work->updated_at = Carbon::now();
        $work->save();
        return redirect()->route('viewSeance', ['id' => $work->seance->id]);
    }

    public function delete( $id ) {
        $work = Work::findOrFail( $id );
        $work->delete();
        return redirect()->back();
    }

    public function store() {
        $errors = Validator::make(Input::all(), $this->rules);
        if ($errors->fails()) {
            return Redirect()->back()->withErrors($errors);
        }
        $works = Work::create([
            'seance_id' => Input::get('seance'),
            'title' => Input::get('title'),
            //'file' => Input::get('file'),
            'description' => Input::get('descr')
            ]);
        
        return redirect()->route('viewSeance', ['id' => Input::get('seance')]);
    }
}
