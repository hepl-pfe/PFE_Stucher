<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Course;
use App\Seance;
use App\Comment;
use \Input;
use Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $createRules = [
        'comment' => 'required',
    ];
    public function create()
    {
        $error = Validator::make(Input::all(), $this->createRules);
        if ($error->fails()) {
            return redirect()->back()->withErrors($error);
        }

        $body = Input::get('comment');
        $from = \Auth::user()->id; // the actif user
        $for = Input::get('for');
        $context = Input::get('context');   // 1 = seance // 2 = test // 3 = work

        $comment = Comment::create([
            'body' => $body,
            'from' => $from,
            'for' => $for,
            'context' => $context
        ]);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id, $ajax = null)
    {
        $comment = Comment::find($id);
        if( $comment == null ) {
            return redirect()->route('home', ['popupError' => "notComment"]);
        } else {
            // Verify if it's my comment => middleware
            if( $comment->from != \Auth::user()->id ) {
                return redirect()->route('home', ['popupError' => "commentAccess"]);
            } else {
                $comment->delete();
                return back();
            }
        }
    }
}
