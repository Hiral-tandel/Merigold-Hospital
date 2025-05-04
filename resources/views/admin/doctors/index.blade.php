<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctors</title>
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
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .doctor-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Manage Doctors</h1>
            <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">Add New Doctor</a>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Specialization</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>
                            @if($doctor->photo)
                                <img src="{{ Storage::url($doctor->photo) }}" alt="{{ $doctor->name }}" class="doctor-image">
                            @else
                                <img src="{{ asset('images/default-doctor.jpg') }}" alt="{{ $doctor->name }}" class="doctor-image">
                            @endif
                        </td>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->email }}</td>
                        <td>{{ $doctor->phone }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this doctor?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> 