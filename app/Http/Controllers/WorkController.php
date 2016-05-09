<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Course;
use App\Seance;
use \Input;
use App\File;
use App\Work;
use Carbon\Carbon;

class WorkController extends Controller
{

    protected $rules = [
        'course' => 'required',
        'seance' => 'required',
        'title' => 'required|max:255',
        'descr' => 'required'
        ];

    public function create( $id = null, $info = null ) {
        setlocale( LC_ALL, 'fr_FR');
        $title = 'Créer un devoir';
        $activePage = 'course';
        $allCourses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        if( $allCourses->first() == null ) {
            return redirect()->back()->withErrors('Vous devez en premier lieux créer un cours');
        }
        if($id == null) {
            $firstCourse = $allCourses->first();
            $allSeances = Seance::where( 'course_id', '=', $firstCourse->id )->get();
            return view('work/createWork', ['title' => $title, 'allCourses' => $allCourses, 'allSeances' => $allSeances, 'activePage' => $activePage]);
        }
        if($id != null) {

             if( $info == 'course' ) {
                $course = Course::findOrFail( $id );
                $allSeances = Seance::where( 'course_id', '=', $id )->get();
                return view('work/createWork', ['title' => $title, 'allCourses' => $allCourses, 'allSeances' => $allSeances, 'course' => $course, 'activePage' => $activePage]);
             }
             if( $info == 'seance' ) {
                $seance = Seance::findOrFail( $id );
                $allSeances = Seance::where( 'course_id', '=', $seance->course_id )->get();
                $course = Course::where( 'id', '=', $seance->course_id )->get();
                return view('work/createWork', ['title' => $title, 'seance' => $seance, 'course'=> $course, 'allCourses' => $allCourses, 'allSeances' => $allSeances, 'activePage' => $activePage]);
             }
        }
    }

    public function store() {
        $errors = Validator::make(Input::all(), $this->rules);
        if ($errors->fails()) {
            return Redirect()->back()->withErrors($errors);
        }

        $workFiles = [];

        if ( !empty( Input::file('file') ) ) {
            $files = Input::file('file');
            if( $files[0] !== null ) {
                $numberFiles = count( $files );
                for ($i = 0; $i < $numberFiles; $i++) {

                    $fileName = $files[$i]->getClientOriginalName();
                    $nameParts = explode('.', $fileName);
                    $ext = strtolower(end($nameParts));

                    if ( $ext == 'jpeg' OR $ext == 'gif' OR $ext == 'png' OR $ext == 'txt' OR $ext == 'pdf' OR $ext == 'docx' OR $ext == 'doc' ) {
                        // compléter la liste au fur et à mesure

                        $type = $ext;
                        $size = $files[$i]->getClientSize()/1000; // poid en Ko
                        $newname = md5( $fileName . time() ) . '.' . $ext;
                        $path = public_path('files/');

                        $file = File::create([
                            'title' => $fileName,
                            'filename' => $newname,
                            'type' => $type,
                            'size' => $size,
                            'from' => \Auth::user()->id
                        ]);

                        $files[$i]->move( $path, $newname);

                        $myFileID = File::where( 'filename', '=', $newname )->first()->id;
                        $workFiles[] = $myFileID;

                    }
                    else {
                        return Redirect()->back()->withErrors('Veuillez entrez un autre format de fichier');
                    }

                }
            }
        }

        $work = Work::create([
            'seance_id' => Input::get('seance'),
            'title' => Input::get('title'),
            'description' => Input::get('descr')
        ]);


        if( !empty( $workFiles ) ) {
            foreach( $workFiles as $workFileID ) {
                \DB::table('file_work')
                    ->insert(
                        array('file_id' => $workFileID, 'work_id' => $work->id)
                    );
            }
        }

        return redirect()->route('viewSeance', ['id' => Input::get('seance')]);
    }

    public function edit( $id ) {
        setlocale( LC_ALL, 'fr_FR');
        $work = Work::findOrFail( $id );
        $title = 'Modifier le devoir';
        $activePage = 'course';
        $allCourses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        $course = Seance::find($work->seance_id)->course;
        $allSeances = Seance::where( 'course_id', '=', $course->id )->get();
        return view('work/updateWork', compact('title', 'work', 'allSeances', 'allCourses', 'activePage'));
    }

    public function update( $id ) {
        $errors = Validator::make(Input::all(), $this->rules);
        if ($errors->fails()) {
            return Redirect()->back()->withErrors($errors);
        }
        $work = Work::findOrFail($id);


        if ( !empty( Input::file('file') ) ) {
            $files = Input::file('file');
            if( $files[0] !== null ) {
                $numberFiles = count( $files );
                for ($i = 0; $i < $numberFiles; $i++) {

                    $fileName = $files[$i]->getClientOriginalName();
                    $nameParts = explode('.', $fileName);
                    $ext = strtolower(end($nameParts));

                    if ( $ext == 'jpeg' OR $ext == 'gif' OR $ext == 'png' OR $ext == 'txt' OR $ext == 'pdf' OR $ext == 'docx' OR $ext == 'doc' ) {
                        // compléter la liste au fur et à mesure

                        $type = $ext;
                        $size = $files[$i]->getClientSize()/1000; // poid en Ko
                        $newname = md5( $fileName . time() ) . '.' . $ext;
                        $path = public_path('files/');

                        $file = File::create([
                            'title' => $fileName,
                            'filename' => $newname,
                            'type' => $type,
                            'size' => $size,
                            'from' => \Auth::user()->id
                        ]);

                        $files[$i]->move( $path, $newname);

                        $myFileID = File::where( 'filename', '=', $newname )->first()->id;
                        $workFiles[] = $myFileID;

                    }
                    else {
                        return Redirect()->back()->withErrors('Veuillez entrez un autre format de fichier');
                    }

                }
            }
        }

        if( !empty( $workFiles ) ) {
            foreach( $workFiles as $workFileID ) {
                \DB::table('file_work')
                    ->insert(
                        array('file_id' => $workFileID, 'work_id' => $work->id)
                    );
            }
        }


        $work->title = Input::get('title');
        $work->description = Input::get('descr');
        $work->updated_at = Carbon::now();
        $work->save();
        return redirect()->route('viewSeance', ['id' => $work->seance->id]);
    }

    public function delete( $id ) {
        $work = Work::findOrFail( $id );
        $work->delete();
        return redirect()->back();
    }

    public function deleteFile( $id_file, $id_work ) {
        \DB::table('file_work')
            ->where('file_id', $id_file)
            ->where('work_id', $id_work)
            ->delete();
        return redirect()->back();
    }
}
