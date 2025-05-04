<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function showLoginForm()
    {
        return view('doctor.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $doctor = Doctor::where('email', $credentials['email'])->first();

        if (!$doctor || !Hash::check($credentials['password'], $doctor->password)) {
            return back()->with('error', 'Invalid email or password');
        }

        if (!$doctor->is_active) {
            return back()->with('error', 'Your account is not active. Please contact the administrator.');
        }

        // Set session variables
        Session::put('doctor_id', $doctor->id);
        Session::put('doctor_name', $doctor->name);
        Session::put('user_type', 'doctor');

        if ($request->has('remember')) {
            $rememberToken = Str::random(60);
            $doctor->remember_token = $rememberToken;
            $doctor->save();
        }

        return redirect()->route('doctor.dashboard');
    }

    public function logout()
    {
        Session::forget(['doctor_id', 'doctor_name', 'user_type']);
        return redirect()->route('doctor.login');
    }
} 