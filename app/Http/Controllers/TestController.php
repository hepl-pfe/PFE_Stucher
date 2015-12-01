<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function create( $id ) {
        $title = 'Créer une interrogation';
        $courses = Course::where( 'teacher_id', '=', \Auth::user()->id )->get();
        return view('test/createTest', ['title' => $title, 'id' => $id, 'courses'=> $courses]);
    }
}
