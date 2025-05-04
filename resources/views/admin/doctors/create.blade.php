<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Doctor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }
        .btn-primary {
            background-color: #002D72;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        .preview-image {
            max-width: 200px;
            margin-top: 10px;
            display: none;
        }
        .password-toggle {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Add New Doctor</h1>
        </div>

        @if($errors->any())
            <div class="error-message">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-toggle">
                    <input type="password" id="password" name="password" value="{{ old('password') }}" required>
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
                <small>This password will be sent to the doctor's email.</small>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
            </div>

            <div class="form-group">
                <label for="specialization">Specialization</label>
                <input type="text" id="specialization" name="specialization" value="{{ old('specialization') }}" required>
            </div>

            <div class="form-group">
                <label for="education">Education</label>
                <textarea id="education" name="education" required>{{ old('education') }}</textarea>
            </div>

            <div class="form-group">
                <label for="experience">Experience</label>
                <textarea id="experience" name="experience" required>{{ old('experience') }}</textarea>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(this)">
                <img id="preview" class="preview-image">
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea id="about" name="about">{{ old('about') }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Doctor</button>
                <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</body>
</html> 