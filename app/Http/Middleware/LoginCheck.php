<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session()->has('loginId')) {
            return redirect('/')->with('fail', 'You have to Login first');
        }

        // Passing down users data for the template
        $id = session("loginId");
        $request->users = User::find($id);

        return $next($request);
    }
}