<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
    public function delete($id)
    {
        if( $comment->from != \Auth::user()->id ) {
            return back()->withErrors('Vous ne pouvez pas supprimer ce commentaire');
        $comment = Comment::find($id);
        }
        $comment->delete();
        return back();
    }
}
