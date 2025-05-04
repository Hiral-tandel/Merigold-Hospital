<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Mail;

class Usercontroller extends Controller
{
    public function create()
    {
        return view('signin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth' => 'required|date',
            'contact' => 'required|string|max:15',
            'gender' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:_users',
            'password' => 'required|string|min:6',
        ]);

        $userData = [
            'name' => $request->name,
            'Birth' => $request->birth,
            'Contact' => $request->contact,
            'Gender' => $request->gender,
            'Address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ];  

        // Insert the user
         DB::table('users')->insert($userData);
        // Send welcome mail
        $user = DB::table('users')
                ->where('email', $request->email)
                ->first();
        Mail::to($user->email)->send(new UserWelcomeMail($user));
        // Send welcome email
        Notification::route('mail', $request->email)
            ->notify(new WelcomeNotification($userData));

        return redirect()->route('login')
            ->with('success', 'Registration successful! Please check your email for welcome information.');
    }
    
}
