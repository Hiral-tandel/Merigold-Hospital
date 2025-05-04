@extends('layouts.user')

@section('content')
<div class="container">
    <div class="welcome-message bg-white p-4 rounded shadow-sm mb-4">
        <h2>Welcome, {{ Session::get('user_name') }}!</h2>
        <p>Welcome to your patient portal. Here you can manage your appointments and access our services.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="fas fa-calendar-check text-primary"></i>
                        Your Appointments
                    </h4>
                    @if($appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>Dr. {{ $appointment->doctor_name }}</td>
                                            <td>{{ date('M d, Y', strtotime($appointment->appointment_date)) }}</td>
                                            <td>{{ date('h:i A', strtotime($appointment->appointment_time)) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No appointments scheduled.</p>
                    @endif
                    <a href="{{ route('Appointment') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus"></i> Book New Appointment
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="fas fa-user-md text-primary"></i>
                        Our Doctors
                    </h4>
                    <p>Find and book appointments with our experienced doctors.</p>
                    <a href="{{ route('doctors.public') }}" class="btn btn-primary">View Doctors</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="fas fa-user-circle text-primary"></i>
                        My Profile
                    </h4>
                    <p>Update your personal information and preferences.</p>
                    <a href="{{ route('Profile') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="fas fa-info-circle text-primary"></i>
                        About Us
                    </h4>
                    <p>Learn more about our hospital and services.</p>
                    <a href="{{ route('About') }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 