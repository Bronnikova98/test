<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserUpdateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $editUser = $request->route()->parameter('user');
        $editUserId = $request->route()->parameter('user')->getKey();
        $editUserRole = $editUser->hasRole('user');

       $authUserId = Auth::id();

        if($editUserId === $authUserId || $editUserRole) {
            return $next($request);
        }
        else {
            abort(403);
        }
    }


}
