@extends('layout')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Doctors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .doctor-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .doctor-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .doctor-info {
            padding: 20px;
        }
        .doctor-name {
            font-size: 1.2em;
            font-weight: bold;
            margin: 0 0 10px 0;
        }
        .doctor-specialization {
            color: #666;
            margin-bottom: 10px;
        }
        .doctor-details {
            margin-top: 10px;
        }
        .doctor-details h4 {
            margin: 10px 0 5px 0;
        }
        .doctor-details p {
            margin: 0;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Our Doctors</h1>
            <p>Meet our experienced medical professionals</p>
        </div>

        <div class="doctors-grid">
            @foreach($doctors as $doctor)
                <div class="doctor-card">
                    @if($doctor->photo)
                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="doctor-image">
                    @else
                        <img src="{{ asset('images/default-doctor.jpg') }}" alt="{{ $doctor->name }}" class="doctor-image">
                    @endif
                    <div class="doctor-info">
                        <h2 class="doctor-name">{{ $doctor->name }}</h2>
                        <div class="doctor-specialization">{{ $doctor->specialization }}</div>
                        
                        <div class="doctor-details">
                            <h4>Education</h4>
                            <p>{{ $doctor->education }}</p>

                            <h4>Experience</h4>
                            <p>{{ $doctor->experience }}</p>

                            @if($doctor->about)
                                <h4>About</h4>
                                <p>{{ $doctor->about }}</p>
                            @endif

                            <h4>Contact</h4>
                            <p>Email: {{ $doctor->email }}</p>
                            <p>Phone: {{ $doctor->phone }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
@endsection