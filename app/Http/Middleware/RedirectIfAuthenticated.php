<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

public function handle(Request $request, Closure $next, ...$guards)
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();

            if ($user->role == 'Admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role == 'Employee') {
                return redirect('/employee/dashboard');
            } else {
                return redirect('/home');
            }
        }
    }

    return $next($request);
} 

}












    /*public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::user()->role === 'Admin') {
    return redirect('/admin/dashboard');
} elseif (Auth::user()->role === 'Employee') {
    return redirect('/employee/dashboard');
} 
        }

        return $next($request);
    }
}*/
