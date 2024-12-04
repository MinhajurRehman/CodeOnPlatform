<?php

namespace App\Http\Middleware;

use App\Models\admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session()->has('AdminloginId')) {
            return redirect('/AdminPanel')->with('fail', 'You have to Login first');
        }

        // Passing down users data for the template
        $id = session("AdminloginId");
        $request->admin_login = admin::where("id", "=", $id)->first();

        return $next($request);
    }
}