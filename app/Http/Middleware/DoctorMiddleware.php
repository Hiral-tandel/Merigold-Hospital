<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DoctorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('doctor_id') || Session::get('user_type') !== 'doctor') {
            return redirect()->route('login')->with('error', 'Please login as a doctor to access this page.');
        }

        return $next($request);
    }
} 