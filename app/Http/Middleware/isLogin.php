<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->level_user == 1) {
                return redirect()->intended('/admin/dashboard');
            }
            elseif (auth()->user()->level_user == 0) {
                return redirect()->intended('/karyawan/dashboard');
            }
        }
        return $next($request);
    }
}
