<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function about(){
        if ( \Auth::check() ) {
    		$title = "à propos";
    		return view('pages/about', ['title' => $title]);
    	}
    	return view('welcome', ['title' => 'accueil']);
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
