<?php 

namespace App\Http\Middleware;

use Closure;

class IsTeacher
{
	public function handle($request, Closure $next)
    {
        $user = $request->user();
 
        if ($user->status == 1)
        {
            return $next($request);
        }
        die('Mais didon !!!! Tu sais que tu ne peux pas faire ça mon petit… hein !?');
    }
}