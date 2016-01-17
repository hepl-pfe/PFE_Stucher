<?php

namespace App\Http\Middleware;

use Closure;
use App\Course;
use App\Seance;

class IsTheTeacher
{
    public function handle($request, Closure $next)
    {
    	//dd($request->segment(1));
        $the_course = Course::where('id', $request->route()->parameter('id'))->get();
        $the_teacher = $the_course->first()->teacher_id;
        if ($the_teacher != \Auth::user()->id) {
           die('TU NE PEUX PAS… TU NE VEUX PAS… ET TU RESTE PLANTÉ LÀ!!!');
        }
        return $next($request);
    }
}
