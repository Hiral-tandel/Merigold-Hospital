@extends('Layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Marigold Hospital</title>
    <style>
        body {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('/images/home2.jpeg');
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 45, 114, 0.8), rgba(0, 45, 114, 0.9)), url('/images/home2.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 120px 20px;
            text-align: center;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 100px;
            background: white;
            transform: skewY(-3deg);
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .mission-vision {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .mission, .vision {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .section-title {
            color: #002D72;
            font-size: 1.8rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: #002D72;
        }

        .facilities {
            margin-bottom: 60px;
        }

        .facility-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 30px;
        }

        .facility-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .facility-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .facility-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .facility-info {
            padding: 20px;
        }

        .facility-info h3 {
            color: #002D72;
            margin-bottom: 10px;
        }

        .stats-section {
            background: linear-gradient(rgba(248, 249, 250, 0.97), rgba(248, 249, 250, 0.97)), url('/images/hospital-pattern.jpg');
            background-attachment: fixed;
            background-size: cover;
            padding: 80px 0;
            margin-bottom: 60px;
            position: relative;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            text-align: center;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-item h3 {
            color: #002D72;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .stat-item p {
            color: #666;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .mission-vision {
                grid-template-columns: 1fr;
            }

            .facility-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .hero-section h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 480px) {
            .facility-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <h1>Welcome to Marigold Hospital</h1>
        <p>Providing Exceptional Healthcare with Compassion and Excellence Since 1995</p>
    </div>

    <div class="about-container">
        <div class="mission-vision">
            <div class="mission">
                <h2 class="section-title">Our Mission</h2>
                <p>To provide exceptional healthcare services that improve the quality of life for our patients and community through innovative medical practices, compassionate care, and continuous advancement in medical excellence.</p>
            </div>
            <div class="vision">
                <h2 class="section-title">Our Vision</h2>
                <p>To be the leading healthcare institution recognized for clinical excellence, patient-centered care, and innovative medical solutions, setting new standards in healthcare delivery and patient satisfaction.</p>
            </div>
        </div>

        <div class="facilities">
            <h2 class="section-title">Our Facilities</h2>
            <div class="facility-grid">
                <div class="facility-card">
                    <img src="{{ asset('images/home2.jpeg') }}" alt="Emergency Department" class="facility-image">
                    <div class="facility-info">
                        <h3>24/7 Emergency Care</h3>
                        <p>State-of-the-art emergency department equipped to handle all medical emergencies with rapid response times.</p>
                    </div>
                </div>
                <div class="facility-card">
                    <img src="{{ asset('images/operation.jpeg') }}" alt="Operation Theatre" class="facility-image">
                    <div class="facility-info">
                        <h3>Modern Operation Theatres</h3>
                        <p>Advanced surgical facilities with the latest medical technology and experienced surgical teams.</p>
                    </div>
                </div>
                <div class="facility-card">
                    <img src="{{ asset('images/diaogony.jpeg') }}" alt="Diagnostic Lab" class="facility-image">
                    <div class="facility-info">
                        <h3>Diagnostic Center</h3>
                        <p>Comprehensive diagnostic services with modern equipment for accurate and timely results.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="stats-section">
            <div class="about-container">
                <div class="stats-grid">
                    <div class="stat-item">
                        <h3>25+</h3>
                        <p>Years of Excellence</p>
                    </div>
                    <div class="stat-item">
                        <h3>100+</h3>
                        <p>Expert Doctors</p>
                    </div>
                    <div class="stat-item">
                        <h3>50K+</h3>
                        <p>Satisfied Patients</p>
                    </div>
                    <div class="stat-item">
                        <h3>24/7</h3>
                        <p>Emergency Care</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection