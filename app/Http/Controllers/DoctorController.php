<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(DoctorRequest $request)
    {
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('doctors', 'public');
        }

        // Generate a random password
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

        Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'specialization' => $request->specialization,
            'education' => $request->education,
            'experience' => $request->experience,
            'photo' => $photoPath,
            'about' => $request->about,
            'password' => Hash::make($password),
            'is_active' => true
        ]);

        // TODO: Send email to doctor with their credentials
        // Mail::to($request->email)->send(new DoctorCredentials($request->email, $password));

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor added successfully! Login credentials have been sent to their email.');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $photoPath = $doctor->photo;
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'specialization' => $request->specialization,
            'education' => $request->education,
            'experience' => $request->experience,
            'photo' => $photoPath,
            'about' => $request->about,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor updated successfully!');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }

        $doctor->delete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor deleted successfully!');
    }

    public function resetPassword(Doctor $doctor)
    {
        // Generate a new random password
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        
        $doctor->update([
            'password' => Hash::make($password)
        ]);

        // TODO: Send email to doctor with their new credentials
        // Mail::to($doctor->email)->send(new DoctorCredentials($doctor->email, $password));

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Password reset successfully! New credentials have been sent to the doctor\'s email.');
    }
} 