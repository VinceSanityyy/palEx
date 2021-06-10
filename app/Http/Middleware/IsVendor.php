<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        if(auth()->user()->role == 1){
            return $next($request);
        }
   
        // return redirect('home')->with('error',"You don't have vendor access.");
        abort(403, "You don't have vendor access.");
    }
}
