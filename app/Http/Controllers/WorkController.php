<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function create( $id ) {
        $title = 'Créer un devoir';
        $courses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        return view('work/createWork', ['title' => $title, 'id' => $id, 'courses'=> $courses]);
    }
}
