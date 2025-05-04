<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{
    // Static admin credentials
    private $adminEmail = 'admin@hospital.com';
    private $adminPassword = 'admin123';

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        if ($request->user_type === 'admin') {
            // Check against static admin credentials
            if ($request->email === $this->adminEmail && $request->password === $this->adminPassword) {
                // Store admin info in session
                Session::put('user_id', 1);
                Session::put('user_type', 'admin');
                Session::put('user_name', 'Admin');
                
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid admin credentials');
            }
        } elseif ($request->user_type === 'doctor') {
            // Check doctor credentials
            $doctor = Doctor::where('email', $request->email)
                ->where('is_active', true)
                ->first();

            if (!$doctor) {
                return redirect()->back()->with('error', 'Invalid email or account is inactive');
            }

            if (Hash::check($request->password, $doctor->password)) {
                // Store doctor info in session
                Session::put('doctor_id', $doctor->id);
                Session::put('user_type', 'doctor');
                Session::put('user_name', $doctor->name);

                return redirect()->route('doctor.dashboard');
            }

            return redirect()->back()->with('error', 'Invalid email or password');
        } else {
            // Check user credentials in database
            $user = DB::table('users')
                ->where('email', $request->email)
                ->first();

            if (!$user) {
                return redirect()->back()->with('error', 'Invalid email or password');
            }

            // Check if the password matches using Hash::check
            if (Hash::check($request->password, $user->password)) {
            // Store user info in session
            Session::put('user_id', $user->id);
            Session::put('user_type', 'user');
            Session::put('user_name', $user->name);

            // Send welcome mail
            //Mail::to($user->email)->send(new UserWelcomeMail($user));

            return redirect()->route('welcome');
            }

            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Session::forget(['user_id', 'doctor_id', 'user_type', 'user_name']);
        return redirect()->route('login');
    }
} 