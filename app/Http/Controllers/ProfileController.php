<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        // Get user's appointments with doctor details
        $appointments = DB::table('appointments')
            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->where('appointments.patient_id', Session::get('user_id'))
            ->select('appointments.*', 'doctors.name as doctor_name', 'doctors.specialization')
            ->orderBy('appointments.appointment_date', 'desc')
            ->orderBy('appointments.appointment_time', 'desc')
            ->get();

        return view('Profile', compact('appointments'));
    }
} 