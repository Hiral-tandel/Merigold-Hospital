@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="welcome-message bg-white p-4 rounded shadow-sm mb-4">
        <h2>Welcome, {{ Session::get('user_name') }}!</h2>
        <p>You are logged in as an administrator.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x text-primary mb-3"></i>
                    <h3 class="card-title">User Management</h3>
                    <p class="card-text">Manage user accounts and permissions</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-2x text-primary mb-3"></i>
                    <h3 class="card-title">Appointments</h3>
                    <p class="card-text">View and manage appointments</p>
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-primary">View Appointments</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user-md fa-2x text-primary mb-3"></i>
                    <h3 class="card-title">Doctors</h3>
                    <p class="card-text">Manage doctor profiles and schedules</p>
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-primary">Manage Doctors</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-star fa-2x text-primary mb-3"></i>
                    <h3 class="card-title">Reviews</h3>
                    <p class="card-text">View and moderate patient reviews</p>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-primary">View Reviews</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-2x text-primary mb-3"></i>
                    <h3 class="card-title">Profile</h3>
                    <p class="card-text">Update your admin profile</p>
                    <a href="{{ route('Profile') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-info-circle fa-2x text-primary mb-3"></i>
                    <h3 class="card-title">About</h3>
                    <p class="card-text">Update hospital information</p>
                    <a href="{{ route('About') }}" class="btn btn-primary">Edit About</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 