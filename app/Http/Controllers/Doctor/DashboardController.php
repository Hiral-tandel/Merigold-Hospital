<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $doctorId = Session::get('doctor_id');
        
        // Get today's appointments
        $todayAppointments = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();

        // Get upcoming appointments (excluding today)
        $upcomingAppointments = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', '>', today())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('doctor.dashboard', compact('todayAppointments', 'upcomingAppointments'));
    }

    public function updateAppointmentStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        // Check if the appointment belongs to the logged-in doctor
        if ($appointment->doctor_id !== Session::get('doctor_id')) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $appointment->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }
} 