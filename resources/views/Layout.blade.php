<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marigold Hospital</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <style>
        /* Navigation Styles */
        nav {
            background: linear-gradient(to right, var(--primary-color), var(--primary-light));
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 5%;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        nav.scrolled {
            padding: 0.6rem 5%;
            background: rgba(33, 158, 188, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-md);
        }

        nav .shop-name {
            color: var(--white);
            font-size: 1.8em;
            font-weight: bold;
            text-decoration: none;
            position: relative;
            transition: var(--transition);
        }

        nav .shop-name::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--white);
            transition: width 0.3s ease;
        }

        nav .shop-name:hover::after {
            width: 100%;
        }

        nav .nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        nav .nav-links a {
            color: var(--white);
            text-align: center;
            padding: 0.7rem 1rem;
            text-decoration: none;
            font-size: 1.1rem;
            position: relative;
            transition: var(--transition);
        }

        nav .nav-links a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background-color: var(--white);
            transition: width 0.3s ease;
        }

        nav .nav-links a:hover::before {
            width: 80%;
        }

        nav .nav-links a:hover {
            transform: translateY(-2px);
        }

        .nav-button {
            background: var(--primary-dark);
            color: var(--white);
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .nav-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.5s ease;
        }

        .nav-button:hover::before {
            left: 100%;
        }

        .nav-button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown > a {
            padding: 0 !important;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: var(--white);
            min-width: 200px;
            box-shadow: var(--shadow-lg);
            z-index: 1;
            right: 0;
            top: 120%;
            border-radius: 12px;
            opacity: 0;
            transform: translateY(10px);
            transition: var(--transition);
        }

        .dropdown:hover .dropdown-content {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .dropdown-content a {
            color: var(--text-dark) !important;
            padding: 1rem 1.5rem !important;
            text-decoration: none;
            display: block;
            font-size: 0.95rem !important;
            transition: var(--transition) !important;
            position: relative;
            z-index: 1;
        }

        .dropdown-content a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, var(--background-light), transparent);
            transition: width 0.3s ease;
            z-index: -1;
        }

        .dropdown-content a:hover::before {
            width: 100%;
        }

        .dropdown-content a:hover {
            color: var(--primary-dark) !important;
            padding-left: 2rem !important;
            background: transparent !important;
        }

        /* Footer Styles */
        footer {
            background: linear-gradient(to right, var(--primary-color), var(--primary-light));
            color: var(--white);
            padding: 3rem 0;
            margin-top: auto;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        footer h3 {
            color: var(--white);
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        footer h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: var(--white);
        }

        footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            transition: var(--transition);
        }

        footer a:hover {
            color: var(--white);
            transform: translateX(5px);
        }

        footer p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.8rem;
            transition: var(--transition);
        }

        footer p:hover {
            color: var(--white);
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 60px - 300px); /* Adjust based on your header and footer height */
            padding: 2rem 0;
        }

        @media (max-width: 768px) {
            nav {
                padding: 0.6rem 3%;
            }

            nav .shop-name {
                font-size: 1.4em;
            }

            nav .nav-links {
                gap: 0.5rem;
            }

            nav .nav-links a {
                padding: 0.5rem 0.8rem;
                font-size: 1rem;
            }

            .nav-button {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('scroll', function() {
                const nav = document.querySelector('nav');
                if (window.scrollY > 50) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            });
        });
    </script>
</head>
<body>
    <nav>
        <a href="#" class="shop-name">Marigold Hospital</a>
        <div class="nav-links">
            <a href="{{ route('welcome') }}" class="slide-in">Home</a>
            <a href="{{ route('About') }}" class="slide-in">About</a>
            <a href="{{ route('doctors.public') }}" class="slide-in">Doctor</a>
            <a href="{{ route('Review') }}" class="slide-in">Review</a>
            <a href="{{ route('Appointment') }}" class="slide-in">Appointment</a>
            <a href="{{ route('welcome') }}" class="slide-in">Contact</a>
            
            @if(Session::has('user_id'))
                <div class="dropdown">
                    @if(Session::get('user_type') === 'admin')
                        <a href="{{ route('admin.dashboard') }}">
                            <button class="nav-button">Profile</button>
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}">
                            <button class="nav-button">Profile</button>
                        </a>
                    @endif
                    <div class="dropdown-content">
                        @if(Session::get('user_type') === 'admin')
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('user.dashboard') }}">Dashboard</a>
                        @endif
                        <a href="{{ route('Profile') }}">My Profile</a>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); 
                           document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">
                    <button class="nav-button">Login</button>
                </a>
            @endif
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-content">
            <div>
                <h3>Quick Links</h3>
                <a href="{{ route('welcome') }}">Home</a>
                <a href="{{ route('About') }}">About Us</a>
                <a href="{{ route('doctors.public') }}">Doctors</a>
                <a href="{{ route('Review') }}">Review</a>
                <a href="{{ route('Appointment') }}">Appointment</a>
                <a href="{{ route('welcome') }}">Contact Us</a>
            </div>
            <div>
                <h3>Contact Us</h3>
                <p>Email: Marigold.hospital@gmail.com</p>
                <p>Phone: +1 555-123-4567</p>
            </div>
            <div>
                <h3>Address</h3>
                <p>123 Main Street</p>
                <p>City, State, ZIP Code</p>
                <p>Country</p>
            </div>
        </div>
    </footer>
</body>
</html>