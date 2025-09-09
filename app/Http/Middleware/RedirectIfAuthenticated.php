<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

//            if(Auth::user()->hasRole('admin')){
//                return redirect(route('admin.dashboard'));
//            }

            $user = auth()->user();
            if($user->hasRole('coordinator')){
                return redirect(route('admin.dashboard'));
            }
            elseif($user->hasRole('supervisor')){
                return redirect(route('supervisor.dashboard'));
            }
            elseif($user->hasRole('student')){
                return redirect(route('student.dashboard.index'));
            }
        }

        return $next($request);
    }
}
