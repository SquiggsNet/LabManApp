<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
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
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        if(Auth::guard($guard)->user()->active != 1){
            Auth::guard($guard)->logout();
            return redirect('/login')->withErrors('Account deactivated, please contact your supervisor.');
        }

        if(Auth::guard($guard)->user()->new_password == 1){
            return view('passwords.index');
        }
        return $next($request);
    }
}
