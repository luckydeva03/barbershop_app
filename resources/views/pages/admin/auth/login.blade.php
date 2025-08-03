<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Backoffice | Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .alert {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .alert ul {
            padding-left: 1.2rem;
        }
        .alert li {
            margin-bottom: 0.25rem;
        }
        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
        }
        .text-danger {
            color: #dc3545 !important;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .login-info {
            background-color: #e7f3ff;
            border: 1px solid #bee5eb;
            border-radius: 0.375rem;
            padding: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            color: #0c5460;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1 class="text-center mb-4">Barbershop Admin Panel</h1>
    
    <!-- Login Info -->
    <div class="login-info">
        <strong>Info Login:</strong><br>
        Email: admin@haircut.com<br>
        Password: password123
    </div>
    
    <form action="{{ route('admin.login.post') }}" method="POST">
        @method('POST')
        @csrf
        
        <!-- Success Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Error Messages -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Rate Limit Warning -->
        @if(session('throttle'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Peringatan!</strong> Terlalu banyak percobaan login. Silakan tunggu {{ session('throttle') }} detik.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                   name="password" required />
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit button -->
        <button type="submit"  class="btn btn-primary btn-block mb-4 w-100">Sign in</button>
    </form>
    <footer class="text-center mt-4">
        <p>&copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Lucky Deva</a></p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>