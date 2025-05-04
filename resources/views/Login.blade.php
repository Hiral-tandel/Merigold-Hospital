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
        max-width: 400px;
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

    .auth-body {
        padding: 2rem;
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
        animation: fadeInUp 0.6s ease-out 0.3s both;
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
        animation: fadeInUp 0.6s ease-out 0.4s both;
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
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Welcome Back</h2>
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

            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                </div>

                <div class="form-group">
                    <label class="form-label" for="user_type">Login As</label>
                    <select name="user_type" id="user_type" class="form-control" required>
                        <option value="user">User</option>
                        <option value="doctor">Doctor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="auth-button">
                    Sign In
                </button>
            </form>

            <div class="auth-footer">
                <p>Don't have an account? <a href="{{ route('Signin') }}">Sign Up</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
