<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Barbershop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e1e1e;
            color: #fff;
        }
        .form-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }
        .btn-gold {
            background-color: #cda434;
            color: #fff;
        }
        .btn-gold:hover {
            background-color: #b8942e;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h3 class="text-center mb-4">Register</h3>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="<?php echo e(route('user.register')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Masukkan ulang password" required>
        </div>
        <button type="submit" class="btn btn-gold w-100">Register</button>
        <p class="mt-3 text-center">Sudah punya akun? <a href="<?php echo e(route('user.login')); ?>" class="text-decoration-none text-warning">Login</a></p>
    </form>
</div>
</body>
</html>
<?php /**PATH E:\laragon\www\backoffice_haircut\resources\views/pages/user/auth/register.blade.php ENDPATH**/ ?>