@extends('Layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <style>
        .profile-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        .section-title {
            color: #002D72;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #002D72;
        }

        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .appointments-table th,
        .appointments-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .appointments-table th {
            background-color: #002D72;
            color: white;
            font-weight: 500;
        }

        .appointments-table tr:hover {
            background-color: #f5f5f5;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-pending {
            background-color: #ffeeba;
            color: #856404;
        }

        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .no-appointments {
            text-align: center;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .no-appointments h3 {
            color: #6c757d;
            margin-bottom: 10px;
        }

        .book-appointment-btn {
            display: inline-block;
            background-color: #002D72;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }

        .book-appointment-btn:hover {
            background-color: #001d4d;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1 class="section-title">My Appointments</h1>

        @if(count($appointments) > 0)
            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Specialization</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>Dr. {{ $appointment->doctor_name }}</td>
                            <td>{{ $appointment->specialization }}</td>
                            <td>{{ date('F j, Y', strtotime($appointment->appointment_date)) }}</td>
                            <td>{{ date('h:i A', strtotime($appointment->appointment_time)) }}</td>
                            <td>{{ $appointment->reason }}</td>
                            <td>
                                <span class="status-badge status-{{ $appointment->status }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-appointments">
                <h3>You don't have any appointments yet</h3>
                <p>Book your first appointment with our experienced doctors</p>
                <a href="{{ route('Appointment') }}" class="book-appointment-btn">Book an Appointment</a>
            </div>
        @endif
    </div>
</body>
</html>
@endsection

