@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="header d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Appointments</h1>
        <a href="{{ route('Appointment') }}" class="btn btn-primary">Book New Appointment</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="filters mb-4">
        <form action="{{ route('admin.appointments.index') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search patient or doctor..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="Start Date">
            </div>
            <div class="col-md-2">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="End Date">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Doctor</th>
                    <th>Specialization</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient_name }}</td>
                        <td>Dr. {{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->doctor->specialization }}</td>
                        <td>{{ $appointment->appointment_date->format('F j, Y') }}</td>
                        <td>{{ $appointment->appointment_time->format('h:i A') }}</td>
                        <td>{{ $appointment->reason }}</td>
                        <td>
                            <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.appointments.update-status', $appointment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                                <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this appointment?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    .filters {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }
    .table th {
        background-color: #f8f9fa;
    }
    .badge {
        padding: 0.5em 1em;
    }
</style>
@endpush 