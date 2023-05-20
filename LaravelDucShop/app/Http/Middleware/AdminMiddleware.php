<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // 0=normal user, 1=admin
            if (Auth::user()->isAdmin == 1) {
                return $next($request);
            } else {
                return redirect('/products')->with(
                    "status",
                    "Access denied , only for admin"
                );
            }
        } else {
            return redirect()->back()->with(
                "status",
                "Please login first"
            );
        }
    }
}
