<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Doctor;
// use App\Notifications\AppointmentNotification;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Notification;
// use App\Models\Appointment;
// use App\Http\Requests\AppointmentRequest;

// class AppointmentController extends Controller
// { -->
    // public function create(Request $request)
    // {
    //     $doctor = null;
    //     if ($request->has('doctor_id')) {
    //         $doctor = Doctor::findOrFail($request->doctor_id);
    //     } else {
    //         $doctors = Doctor::all();
    //     }

    //     return view('Appointment', compact('doctor', 'doctors'));
    // }

    // public function store(AppointmentRequest $request)
    // {
        // Check if the time slot is available
        // $existingAppointment = Appointment::where('doctor_id', $request->doctor_id)
        //     ->where('appointment_date', $request->appointment_date)
        //     ->where('appointment_time', $request->appointment_time)
        //     ->where('status', '!=', 'cancelled')
        //     ->first();

        // if ($existingAppointment) {
        //     return back()->withErrors(['appointment_time' => 'This time slot is already booked. Please select another time.'])->withInput();
        // }

        // Create the appointment
//         $appointment = Appointment::create([
//             'doctor_id' => $request->doctor_id,
//             'patient_id' => Session::get('user_id'),
//             'patient_name' => $request->patient_name,
//             'appointment_date' => $request->appointment_date,
//             'appointment_time' => $request->appointment_time,
//             'reason' => $request->reason,
//             'status' => 'pending'
//         ]);

//         return redirect()->route('appointments.success')->with('success', 'Appointment booked successfully! We will notify you once it is confirmed.');
//     }
// } 


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $doctors = Doctor::all();
        $selectedDoctorId = $request->query('doctor_id');
        
        return view('Appointment', compact('doctors', 'selectedDoctorId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'reason' => 'required|string|max:500',
            'patient_name' => Session::has('user_id') ? '' : 'required|string|max:255',
        ]);

        $appointment = [
            'doctor_id' => $request->doctor_id,
            'patient_id' => Session::get('user_id'),
            'patient_name' => Session::has('user_id') ? Session::get('user_name') : $request->patient_name,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('appointments')->insert($appointment);

        return redirect()->back()->with('success', 'Appointment booked successfully! We will contact you for confirmation.');
    }
} 