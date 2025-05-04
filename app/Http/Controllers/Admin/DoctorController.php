<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Mail\DoctorWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function publicIndex()
    {
        $doctors = Doctor::all();
        return view('doctors.public', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
            'specialization' => 'required|string|max:255',
            'education' => 'required|string',
            'experience' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'about' => 'nullable|string'
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('doctors', 'public');
            $validated['photo'] = $photoPath;
        }

        // Hash the password
        $password = $validated['password'];
        $validated['password'] = Hash::make($password);

        // Create the doctor
        $doctor = Doctor::create($validated);

        // Send welcome email
        try {
            Mail::to($doctor->email)->send(new DoctorWelcomeMail($doctor, $password));
        } catch (\Exception $e) {
            // Log the error but don't stop the process
            \Log::error('Failed to send welcome email to doctor: ' . $e->getMessage());
        }

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor added successfully and welcome email has been sent.');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone' => 'required|string|max:20',
            'specialization' => 'required|string|max:255',
            'education' => 'required|string',
            'experience' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'about' => 'nullable|string'
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $photoPath = $request->file('photo')->store('doctors', 'public');
            $validated['photo'] = $photoPath;
        }

        $doctor->update($validated);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }
        
        $doctor->delete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor deleted successfully.');
    }
} 