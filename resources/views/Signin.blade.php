@extends('Layout')

@section('content')
<style>
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(135deg, rgba(33, 158, 188, 0.1), rgba(0, 45, 114, 0.1));
    }

    .auth-card {
        background: var(--white);
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        width: 100%;
        max-width: 500px;
        animation: fadeIn 0.6s ease-out;
    }

    .auth-header {
        background: linear-gradient(to right, var(--primary-color), var(--primary-light));
        padding: 2rem;
        text-align: center;
        color: var(--white);
    }

    .auth-header h2 {
        color: var(--white);
        margin: 0;
        font-size: 1.8rem;
        animation: fadeInDown 0.6s ease-out;
    }

    .auth-header p {
        color: rgba(255, 255, 255, 0.9);
        margin-top: 0.5rem;
        font-size: 1rem;
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }

    .auth-body {
        padding: 2rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .form-group:nth-child(2) {
        animation-delay: 0.1s;
    }

    .form-group:nth-child(3) {
        animation-delay: 0.2s;
    }

    .form-group:nth-child(4) {
        animation-delay: 0.3s;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 2px solid #eee;
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
        background-color: #f8f9fa;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(33, 158, 188, 0.1);
        background-color: var(--white);
    }

    .auth-button {
        width: 100%;
        padding: 1rem;
        border: none;
        border-radius: 8px;
        background: linear-gradient(to right, var(--primary-color), var(--primary-light));
        color: var(--white);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 1rem;
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out 0.4s both;
    }

    .auth-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .auth-button:hover::before {
        left: 100%;
    }

    .auth-button:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        background: linear-gradient(to right, var(--primary-light), var(--primary-color));
    }

    .auth-footer {
        text-align: center;
        margin-top: 1.5rem;
        animation: fadeInUp 0.6s ease-out 0.5s both;
    }

    .auth-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
    }

    .auth-footer a:hover {
        color: var(--primary-dark);
    }

    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        animation: fadeIn 0.6s ease-out;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @media (max-width: 576px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Join us for better healthcare services</p>
        </div>
        <div class="auth-body">
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your full name">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="birth">Date of Birth</label>
                        <input type="date" class="form-control" id="birth" name="birth" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="contact">Contact Number</label>
                        <input type="tel" class="form-control" id="contact" name="contact" required placeholder="Enter your contact number">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required placeholder="Enter your address">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Create a password">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
                    </div>
                </div>

                <button type="submit" class="auth-button">
                    Create Account
                </button>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
