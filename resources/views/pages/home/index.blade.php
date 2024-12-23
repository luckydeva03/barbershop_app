<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altoz BarberShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .navbar {
            padding: 1rem;
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .navbar.transparent {
            background-color: rgba(0, 0, 0, 0.3) !important;
        }

        .navbar.scrolled {
            background-color: #000 !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            font-size: 1.25rem;
            padding: 0.75rem 1rem;
        }

        .hero {
            background: url('{{ asset('images/background.png') }}') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 120px 20px;
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
            z-index: 1;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero p {
            margin: 20px 0;
            font-size: 1.2rem;
        }

        .btn-primary {
            background-color: #ffc107;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e0a800;
        }

        .about img {
            max-width: 100%;
        }

        .testimonials {
            background-color: #f8f9fa;
            padding: 50px 0;
        }

        .testimonial-item {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: white;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        @media (max-width: 767.98px) {
            .navbar {
                background-color: #000 !important;
            }
        }
    </style>
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark transparent fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Altoz Barbershop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">Testimonials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="#testimonials">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person me-2" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                        Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="hero">
    <div class="container">
        <h1>Redefining the Barbershop Experience</h1>
        <p>Marco’s Chop Shop provides premium grooming services, focusing on quality and attention to detail to inspire confidence in every man. Each visit is designed as more than just a haircut—it's a tailored experience for the modern gentleman.</p>
        <a href="#" class="btn btn-lg btn-primary me-2">Book Now</a>
        <a href="#" class="btn btn-lg btn-outline-light">Our Stores</a>
    </div>
</header>

<!-- About Section -->
<section id="about" class="about py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/image1.png') }}" alt="About Image">
            </div>
            <div class="col-md-6">
                <h2>Grooming for the Greater Good</h2>
                <p>Marco's Chop Shop is a premium grooming destination setting a new standard for men's grooming in
                    Indonesia. With our main location in Jakarta and branches in Tangerang and Bali, we welcome
                    gentlemen who seek more than just a haircut. Our goal is to offer a unique, premium, and
                    effortless experience that inspires confidence and builds lasting loyalty.</p>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="gallery py-5">
    <div class="container text-center">
        <h2>Inside Marco's Chop Shop</h2>
        <p>One Stop Premium Barbershop Experience</p>
        <div class="row">
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/image2.png') }}" width="400" height="400" class="img-fluid rounded" alt="Gallery Image 1">
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/image2.png') }}" width="400" height="400" class="img-fluid rounded" alt="Gallery Image 2">
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/image2.png') }}" width="400" height="400" class="img-fluid rounded" alt="Gallery Image 3">
            </div>
        </div>
        <a href="#" class="btn btn-primary">See More Captured Moments</a>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials">
    <div class="container">
        <h2 class="text-center mb-5">Testimonials</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="testimonial-item">
                    <p>"The best barbershop experience I've ever had. Highly recommended!"</p>
                    <strong>- John Doe</strong>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-item">
                    <p>"Great service and attention to detail. Will definitely come back!"</p>
                    <strong>- Jane Smith</strong>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-item">
                    <p>"Amazing atmosphere and skilled barbers. Five stars!"</p>
                    <strong>- Mike Johnson</strong>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2024 Altoz Hub. All rights reserved.</p>
    </div>
</footer>

<script>
    // Change navbar background on scroll
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > window.innerHeight) {
            navbar.classList.add('scrolled');
            navbar.classList.remove('transparent');
        } else {
            navbar.classList.add('transparent');
            navbar.classList.remove('scrolled');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
