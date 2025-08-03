<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Altoz BarberShop'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            padding: 1rem;
            background-color: #343a40 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            color: #adb5bd !important;
            font-weight: 500;
            margin: 0 10px;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #fff !important;
        }

        .btn-primary {
            background-color: #667eea;
            border-color: #667eea;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #764ba2;
            border-color: #764ba2;
            transform: translateY(-1px);
        }

        .btn-success {
            background-color: #25d366;
            border-color: #25d366;
        }

        .btn-success:hover {
            background-color: #128c7e;
            border-color: #128c7e;
        }

        .card {
            border: none;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .text-primary {
            color: #667eea !important;
        }

        .border-primary {
            border-color: #667eea !important;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">Altoz Barbershop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/stores">Our Stores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/booking">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="/dashboard">
                            <i class="bi bi-person me-2"></i>
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="padding-top: 80px;">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Altoz BarberShop</h5>
                    <p class="mb-0">Premium grooming experience for the modern gentleman.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <i class="bi bi-telephone me-2"></i>
                        +62 819-9776-5903
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-envelope me-2"></i>
                        luckydeva2003@gmail.com
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH E:\laragon\www\backoffice_haircut\resources\views/layouts/booking.blade.php ENDPATH**/ ?>