<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use \Input;

use App\Course;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{

    protected $rules = [
        'name' => 'required|max:255',
        // 'surname' => 'required|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|min:6',
        // 'image' => 'required'
        ];

    public function about(){
        if ( \Auth::check() ) {
    		$title = "à propos";
            $nbCourses = Course::where('teacher_id', '=', \Auth::user()->id)->count();
            $courses = Course::where('teacher_id', '=', \Auth::user()->id)->get();
            $myUsers = [];
            foreach ($courses as $course) {
            
             $users =  $course->users;
             foreach ($users as $user) {
                if (!in_array($user->id, $myUsers)) {
                    array_push($myUsers, $user->id);
                }
             }
            }
            $nbUsers = count($myUsers);
    		return view('pages/about', compact('title', 'nbCourses', 'nbUsers'));
    	}
    	return view('welcome', ['title' => 'accueil']);
    }

    public function editProfil() {
        $title = 'Modifier votre profil';
        $id = \Auth::user()->id;
        $user = User::findOrFail($id);
        $name = $user->name;
        $email = $user->email;
        return view('pages/updateProfil', compact('id', 'name', 'email', 'title'));
    }

    public function updateProfil() {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            // echo $validator->messages('title'); die();
            return redirect()->back();
        }
        $user = User::where( 'id', '=', \Auth::user()->id );
        $user->name = Input::get('name');
        //$user->name = Input::get('surname');
        $user->name = Input::get('email');
        $user->name = bcrypt(Input::get('password'));
        //$user->name = Input::get('image');
        return redirect()->route('about');
    }

    public function deleteProfil() {
        $id = \Auth::user()->id;
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('indexCourse');
    }

    public function notification(){
        if ( \Auth::check() ) {
            $title = "Notifications";
            return view('pages/notification', ['title' => $title]);
        }
        return view('welcome', ['title' => $title]);
    }

    public function message(){
        if ( \Auth::check() ) {
            $title = "Message";
            return view('pages/message', ['title' => $title]);
        }
        return view('welcome', ['title' => $title]);
    }

    public function newMessage(){
        if ( \Auth::check() ) {
            return view('pages/newMessage');
        }
        return view('welcome', ['title' => $title]);
    }

    public function repMessage(){
        if ( \Auth::check() ) {
            return view('pages/repMessage');
        }
        return view('welcome', ['title' => $title]);
    }

    public function planning(){
        if ( \Auth::check() ) {
            $title = "Planning";
            return view('pages/planning', ['title' => $title]);
        }
        return view('welcome', ['title' => $title]);
    }

    public function home(){
    	if ( \Auth::check() ) {
    		$title = "Tous mes cours";
    		return view( 'courses/indexCourses', ['title' => $title] );
    	}
    	return view('welcome', ['title' => $title]);
    }

    public function registerTeacher(){
            $title = "Créer un compte professeur";
            return view( 'auth/registerTeacher', ['title' => $title] );
    }

    public function registerStudent(){
            $title = "Créer un compte étudiant";
            return view( 'auth/registerStudent', ['title' => $title] );
    }
}
