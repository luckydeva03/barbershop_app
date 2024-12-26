<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Altoz BarberShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            padding: 1rem;
            background-color: #343a40;
            color: #fff;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            padding-top: 5rem; /* Adjust this value as needed */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }

        .content {
            padding: 2rem;
            margin-top: 5rem;
        }

        .card-header {
            background-color: #ffc107;
            color: #000;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .btn-primary {
            background-color: #ffc107;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e0a800;
        }

        .btn-primary:focus, .btn-primary:active {
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.5);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                display: none;
            }
        }

        @media (min-width: 768px) {
            .navbar-nav {
                display: none;
            }
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Altoz BarberShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto d-block d-md-none">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-user"></i> Profile</a>
                    <a class="nav-link" href="#"><i class="fa-solid fa-gift"></i> Redeem Code</a>
                    <a class="nav-link" href="#"><i class="fa-solid fa-history"></i> Transaction History</a>
                    <a class="nav-link" href="{{route('user.logout')}}"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar d-none d-md-block position-fixed">
            <a href="#"><i class="fa-solid fa-user me-2"></i> Profile</a>
            <a href="#"><i class="fa-solid fa-gift me-2"></i> Redeem Code</a>
            <a href="#"><i class="fa-solid fa-history me-2"></i> Transaction History</a>
            <form action="{{ route('user.logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-sign-out-alt me-2"></i> Logout</button>
        </nav>
        <main class="col-md-10 ms-sm-auto col-lg-10 offset-md-2 px-md-4 content">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
