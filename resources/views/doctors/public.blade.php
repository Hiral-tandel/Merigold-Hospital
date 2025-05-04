@extends('Layout')
@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Doctors</title>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .doctors-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards;
        }

        .section-title {
            text-align: center;
            color: #002D72;
            margin-bottom: 40px;
            font-size: 2.5rem;
            font-weight: bold;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #002D72;
        }

        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            padding: 20px;
            justify-items: center;
        }

        .doctor-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            width: 300px;
            height: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            animation: fadeIn 0.5s ease-out forwards;
            animation-delay: calc(var(--card-index) * 0.1s);
            opacity: 0;
        }

        .doctor-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #002D72, #0056b3);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .doctor-card:hover::before {
            transform: scaleX(1);
        }

        .doctor-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .image-container {
            width: 220px;
            height: 220px;
            margin: 25px auto 20px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #f8f9fa;
            border: 4px solid #002D72;
        }

        .doctor-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.3s ease;
        }

        .doctor-card:hover .doctor-image {
            transform: scale(1.1);
        }

        .doctor-info {
            padding: 20px;
            width: 100%;
            text-align: center;
        }

        .doctor-name {
            color: #002D72;
            font-size: 1.4rem;
            font-weight: bold;
            margin: 0 0 10px 0;
        }

        .doctor-card:hover .doctor-name {
            color: #0056b3;
        }

        .doctor-specialization {
            color: #0056b3;
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0 0 15px 0;
        }

        .doctor-card:hover .doctor-specialization {
            transform: scale(1.05);
        }

        .doctor-education {
            color: #444;
            font-size: 0.95rem;
            margin: 0 0 10px 0;
            line-height: 1.4;
        }

        .doctor-experience {
            color: #444;
            font-size: 0.95rem;
            margin: 0 0 20px 0;
        }

        .book-appointment-btn {
            background: #002D72;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: auto;
        }

        .book-appointment-btn:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 45, 114, 0.3);
        }

        .no-doctors {
            text-align: center;
            padding: 60px;
            color: #666;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .doctors-grid {
                grid-template-columns: 1fr;
                padding: 15px;
            }

            .doctor-card {
                width: 100%;
                max-width: 300px;
                height: 480px;
            }

            .image-container {
                width: 180px;
                height: 180px;
                margin: 20px auto 15px;
            }
        }
    </style>
</head>
<body>
    <div class="doctors-container">
        <h1 class="section-title">Our Expert Doctors</h1>

        @if(count($doctors) > 0)
            <div class="doctors-grid">
                @foreach($doctors as $index => $doctor)
                    <div class="doctor-card" style="--card-index: {{ $index }}">
                        <div class="image-container">
                            @if($doctor->photo && Storage::disk('public')->exists($doctor->photo))
                                <img src="{{ Storage::url($doctor->photo) }}" alt="Dr. {{ $doctor->name }}" class="doctor-image">
                            @else
                                <img src="{{ asset('images/default-doctor.jpg') }}" alt="Dr. {{ $doctor->name }}" class="doctor-image">
                            @endif
                        </div>
                        <div class="doctor-info">
                            <h2 class="doctor-name">Dr. {{ $doctor->name }}</h2>
                            <p class="doctor-specialization">{{ $doctor->specialization }}</p>
                            <p class="doctor-education">{{ $doctor->education }}</p>
                            <p class="doctor-experience">{{ $doctor->experience }} Years of Experience</p>
                            <a href="{{ route('Appointment', ['doctor_id' => $doctor->id]) }}" class="book-appointment-btn">Book Appointment</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-doctors">
                <p>No doctors available at the moment.</p>
            </div>
        @endif
    </div>
</body>
</html>
@endsection 