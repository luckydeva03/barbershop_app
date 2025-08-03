<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Stores - Altoz BarberShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .navbar {
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .navbar.transparent {
            background-color: rgba(0, 0, 0, 0.3) !important;
        }
        .navbar.scrolled {
            background-color: #000 !important;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
        }
        .navbar-nav .nav-link {
            font-weight: 500;
            margin: 0 10px;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8rem 0 4rem 0;
            margin-top: 56px; /* Account for fixed navbar */
        }
        .store-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 600px;
            position: relative;
        }
        .store-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .store-image {
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            height: 400px;
            position: relative;
            padding-bottom: 120px !important;
        }
        .store-info {
            overflow: hidden;
            max-height: 200px;
        }
        .card-buttons {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            right: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
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
                        <a class="nav-link active" href="/stores">Our Stores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/booking">Booking</a>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">Our Store Locations</h1>
                    <p class="lead mb-4">Find the nearest Altoz BarberShop location to you</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <!-- Store Cards -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="text-center mb-4">All Locations</h2>
                </div>
            </div>
            <!-- Store Cards Section -->
            <div class="row g-4 mb-5">
                <?php if($stores && $stores->count() > 0): ?>
                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('components.store-card', ['store' => $store], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i>
                            No store locations available at the moment.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH E:\laragon\www\backoffice_haircut\resources\views/pages/stores/index.blade.php ENDPATH**/ ?>