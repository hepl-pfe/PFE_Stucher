<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Courses;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function about(){
        if ( \Auth::check() ) {
    		$title = "à propos";
            $nbCourses = Courses::where('teacher_id', '=', \Auth::user()->id)->count();
    		return view('pages/about', compact('title', 'nbCourses'));
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

    }

    public function deleteProfil() {
        $id = \Auth::user()->id;
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('indexCourses');
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
