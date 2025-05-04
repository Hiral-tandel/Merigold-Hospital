<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        if (Session::get('user_type') !== 'admin') {
            return redirect()->route('login');
        }

        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }
} 