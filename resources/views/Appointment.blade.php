@extends('Layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <style>
        .appointment-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .section-title {
            color: #002D72;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #002D72;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .btn-primary {
            background-color: #002D72;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #001d4d;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        .doctor-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .doctor-info h3 {
            color: #002D72;
            margin-bottom: 10px;
        }

        .doctor-info p {
            margin: 5px 0;
            color: #666;
        }

        .doctor-select {
            display: none;
        }
    </style>
</head>
<body>
    <div class="appointment-container">
        <h1 class="section-title">Book an Appointment</h1>

        @if($errors->any())
            <div class="error-message">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            
            @if(isset($doctor))
                <div class="doctor-info">
                    <h3>Selected Doctor</h3>
                    <p><strong>Name:</strong> Dr. {{ $doctor->name }}</p>
                    <p><strong>Specialization:</strong> {{ $doctor->specialization }}</p>
                    <p><strong>Experience:</strong> {{ $doctor->experience }}</p>
                </div>
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
            @else
                <div class="form-group">
                    <label for="doctor_id">Select Doctor</label>
                    <select id="doctor_id" name="doctor_id" class="form-control" required>
                        <option value="">Choose a doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                Dr. {{ $doctor->name }} - {{ $doctor->specialization }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" id="patient_name" name="patient_name" value="{{ old('patient_name', Session::get('user_name')) }}" required>
            </div>

            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" required min="{{ date('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label for="appointment_time">Appointment Time</label>
                <input type="time" id="appointment_time" name="appointment_time" value="{{ old('appointment_time') }}" required>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Visit</label>
                <textarea id="reason" name="reason" required>{{ old('reason') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Book Appointment</button>
        </form>
    </div>
</body>
</html>
@endsection