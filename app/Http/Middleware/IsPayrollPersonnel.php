<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsPayrollPersonnel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth()->check() || !Auth()->user()->isPayrollPersonnel(Auth()->user()::PERMISSION_CODE)) {
            Auth::logout();
            abort(403, "You are not allowed to view this resources!");
        }

        return $next($request);
    }
}
