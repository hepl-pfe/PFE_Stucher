<?php

namespace App\Http\Middleware;

use Closure;
use App\Course;
use App\Seance;
use App\Work;
use App\Test;
use App\Comment;

class IsTheTeacher
{
    public function handle($request, Closure $next)
    {
        if ( in_array('course', $request->segments()) ) 
        {
            $the_course = Course::where('id', $request->route()->parameter('id'))->first();

            if( $the_course == null )
            {
                die( 'Ce cours n’existe pas' );
            } else {
                $the_teacher = $the_course->teacher_id;

                if ($the_teacher != \Auth::user()->id)
                {
                    die('TU NE PEUX PAS… TU NE VEUX PAS… ET TU RESTE PLANTÉ LÀ!!!');
                }
            }

        } else if ( in_array('seance', $request->segments()) ) 
            {
                $the_seance = Seance::where('id', $request->route()->parameter('id'))->first();

                if( $the_seance == null )
                {
                    die( 'Cette séance n’existe pas' );
                } else {
                    $the_course = Course::findOrFail($the_seance->course_id);
                    $the_teacher = $the_course->teacher_id;

                    if ($the_teacher != \Auth::user()->id)
                    {
                        die('TU NE PEUX PAS… TU NE VEUX PAS… ET TU RESTE PLANTÉ LÀ!!!');
                    }
                }
            } else if ( in_array('work', $request->segments()) )
                {
                    $the_work = Work::where('id', $request->route()->parameter('id'))->first();

                    dd('ok-work');

                    if( $the_work == null )
                    {
                        die( 'Cette devoir n’existe pas' );
                    } else {
                        $the_seance = Course::findOrFail($the_work->seance_id);
                        $the_course = Course::findOrFail($the_seance->course_id);
                        $the_teacher = $the_course->teacher_id;

                        if ($the_teacher != \Auth::user()->id)
                        {
                            die('TU NE PEUX PAS… TU NE VEUX PAS… ET TU RESTE PLANTÉ LÀ!!!');
                        }
                    }
        return $next($request);
    }
}
