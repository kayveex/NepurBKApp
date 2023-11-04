<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $role): Response
    // {
    //     if (auth()->user()->role == $role ) {
    //         return $next($request);
    //     }
    //     return response()->json(['Anda tidak diperbolehkan untuk mengakses fitur ini!']);
    // }
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $allowedRoles = explode('|', $roles);

        if (auth()->check() && in_array(auth()->user()->role, $allowedRoles)) {
            return $next($request);
        }

        return response()->json(['Anda tidak diperbolehkan untuk mengakses fitur ini!']);
    }
}
