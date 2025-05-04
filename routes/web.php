<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Api\UserController as ApiUserController;

Route::middleware('api')->group(function () {
    Route::get('/api/users', [ApiUserController::class, 'index']);
});
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\DoctorMiddleware;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/doctors', [DoctorController::class, 'publicIndex'])->name('doctors.public');
Route::get('/About', function () { return view('About'); })->name('About');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User Registration Routes
Route::get('/Signin', [Usercontroller::class, 'create'])->name('Signin');
Route::post('/user/store', [Usercontroller::class, 'store'])->name('user.store');

// User Dashboard and Features
Route::get('/user/dashboard', function () {
    if (Session::get('user_type') !== 'user') {
        return redirect()->route('login');
    }
    
    $appointments = DB::table('appointments')
        ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
        ->where('appointments.patient_id', Session::get('user_id'))
        ->select('appointments.*', 'doctors.name as doctor_name', 'doctors.specialization')
        ->orderBy('appointments.appointment_date', 'desc')
        ->orderBy('appointments.appointment_time', 'desc')
        ->get();
    
    return view('user.dashboard', compact('appointments'));
})->name('user.dashboard');

Route::get('/book-appointment', [AppointmentController::class, 'index'])->name('Appointment');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/Profile', [ProfileController::class, 'index'])->name('Profile');

// Review Routes
Route::get('/Review', [ReviewController::class, 'index'])->name('Review');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Doctor Routes
Route::middleware([DoctorMiddleware::class])->group(function () {
    Route::get('/doctor/dashboard', [App\Http\Controllers\Doctor\DashboardController::class, 'index'])->name('doctor.dashboard');
    Route::patch('/doctor/appointments/{appointment}/status', [App\Http\Controllers\Doctor\DashboardController::class, 'updateAppointmentStatus'])->name('doctor.appointments.update-status');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['web'])->group(function () {
    Route::get('/dashboard', function () {
        if (Session::get('user_type') !== 'admin') {
            return redirect()->route('login');
        }
        return view('admin.dashboard');
    })->name('dashboard');

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::resource('doctors', DoctorController::class);
        Route::get('/manage-users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::get('/manage-appointments', [App\Http\Controllers\Admin\AppointmentController::class, 'index'])->name('appointments.index');
        Route::patch('/manage-appointments/{appointment}/status', [App\Http\Controllers\Admin\AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
        Route::delete('/manage-appointments/{appointment}', [App\Http\Controllers\Admin\AppointmentController::class, 'destroy'])->name('appointments.destroy');
        
        // Admin Review Management
        Route::get('/reviews', [ReviewController::class, 'adminIndex'])->name('reviews.index');
        Route::patch('/reviews/{review}/status', [ReviewController::class, 'updateStatus'])->name('reviews.update-status');

        // Doctor Management
        Route::post('/doctors/{doctor}/reset-password', [App\Http\Controllers\DoctorController::class, 'resetPassword'])->name('doctors.reset-password');
    });
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/add',[Usercontroller::class,'addUser']);





