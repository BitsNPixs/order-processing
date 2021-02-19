<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, \Closure $next, $guard = null)
    {
        if(!Auth::guard($guard)->check()){

            if($request->ajax() || $request->wantsJson()){
                return response('Unauthorized.', 401);
            }
            if($guard === 'admin'){
                return redirect()->guest(route('admin.login'));
            }
            else{
                return redirect()->guest(route('login'));
            }
        }

        return $next($request);
    }
}
