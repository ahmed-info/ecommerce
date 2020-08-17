<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //login middleware

          $ages = Auth::user()-> age;
          
            if($ages < 15){
                return redirect() -> route('not.adult');
            }
          
      
        return $next($request);
    }
}