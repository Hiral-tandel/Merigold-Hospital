@extends('Layout')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Today's Schedule</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Time</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Patient Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Reason</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($todayAppointments as $appointment)
                                <tr class="{{ $appointment->status === 'pending' ? 'table-warning' : ($appointment->status === 'confirmed' ? 'table-success' : 'table-danger') }}">
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $appointment->appointment_time }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $appointment->patient_name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $appointment->reason }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-{{ $appointment->status === 'pending' ? 'warning' : ($appointment->status === 'confirmed' ? 'success' : 'danger') }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('doctor.appointments.update-status', $appointment) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No appointments scheduled for today</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Upcoming Appointments</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Time</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Patient Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Reason</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($upcomingAppointments as $appointment)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $appointment->appointment_date }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $appointment->appointment_time }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $appointment->patient_name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $appointment->reason }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-{{ $appointment->status === 'pending' ? 'warning' : ($appointment->status === 'confirmed' ? 'success' : 'danger') }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No upcoming appointments</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 