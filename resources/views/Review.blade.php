@extends('Layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review - Marigold Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('/images/home2.jpeg');
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .review-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: #002D72;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 30px;
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

        .rating-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .star-rating {
            display: inline-flex;
            flex-direction: row-reverse;
            gap: 5px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: #ffd700;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #002D72;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #002D72;
            box-shadow: 0 0 0 2px rgba(0, 45, 114, 0.1);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background: #002D72;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background: #001d4d;
            transform: translateY(-2px);
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .review-container {
                margin: 20px;
                padding: 20px;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .star-rating label {
                font-size: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="review-container">
        <h1 class="section-title">Share Your Experience</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                <ul style="list-style: none; margin: 0; padding: 0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <div class="rating-container">
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required>
                    <label for="star5" class="fas fa-star"></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4" class="fas fa-star"></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3" class="fas fa-star"></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2" class="fas fa-star"></label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1" class="fas fa-star"></label>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="comment">Your Review</label>
                <textarea id="comment" name="comment" class="form-control" required>{{ old('comment') }}</textarea>
            </div>

            <button type="submit" class="submit-btn">Submit Review</button>
        </form>
    </div>
</body>
</html>
@endsection