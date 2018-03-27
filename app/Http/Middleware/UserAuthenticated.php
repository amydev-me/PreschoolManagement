<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class UserAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)
    {
        if(Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message'=>'unauthorized','status'=>'401'], 401);
            } else {
                if (!Auth::user()) {
                    return redirect('/login');
                }
            }
        }
        return $next($request);
    }
}
