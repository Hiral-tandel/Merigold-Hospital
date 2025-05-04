@extends('Layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Marigold Hospital</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('/images/home2.jpeg');
            background-attachment: fixed;
            background-size: cover;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 45, 114, 0.7), rgba(0, 45, 114, 0.8)), url('/images/home2.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 150px 20px;
            text-align: center;
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

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease 0.2s;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            background: #fff;
            color: #002D72;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease 0.4s;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            background: #002D72;
            color: white;
        }

        .features-section {
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #002D72;
            margin-bottom: 20px;
        }

        .feature-title {
            font-size: 1.5rem;
            color: #002D72;
            margin-bottom: 15px;
        }

        .feature-description {
            color: #666;
            line-height: 1.6;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Welcome to Marigold Hospital</h1>
            <p class="hero-subtitle">Providing Exceptional Healthcare with Compassion and Excellence</p>
            <a href="{{ route('Appointment') }}" class="cta-button">Book an Appointment</a>
        </div>
    </div>

    <div class="features-section">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">👨‍⚕️</div>
                <h3 class="feature-title">Expert Doctors</h3>
                <p class="feature-description">Our team of highly qualified and experienced medical professionals is dedicated to providing the best care.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🏥</div>
                <h3 class="feature-title">Modern Facilities</h3>
                <p class="feature-description">State-of-the-art medical facilities and equipment to ensure accurate diagnosis and treatment.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🚑</div>
                <h3 class="feature-title">24/7 Emergency</h3>
                <p class="feature-description">Round-the-clock emergency services with rapid response times for immediate care.</p>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
