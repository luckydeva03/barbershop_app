<?php $__env->startSection('content'); ?>
    <div class="container py-3">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-4 mb-5">
                <div class="card shadow-lg border-0 rounded-xl overflow-hidden">
                    <div class="card-body text-center">
                        <!-- Profile Image with elegant frame -->
                        <?php if($user->avatar): ?>
                            <img src="<?php echo e($user->avatar); ?>" class="img-fluid rounded-circle mb-4 border border-dark" alt="Profile Image" style="width: 150px; height: 150px; object-fit: cover;">
                        <?php else: ?>
                            <img src="<?php echo e(asset('images/user.jpg')); ?>" class="img-fluid rounded-circle mb-4 border border-dark" alt="Profile Image" style="width: 150px; height: 150px;">
                        <?php endif; ?>
                        <h4 class="card-title font-weight-bold text-dark mb-2"><?php echo e($user->name); ?></h4>
                        <p class="card-text text-muted mb-2"><strong>Email:</strong> <?php echo e($user->email); ?></p>
                        <?php if($user->provider === 'google'): ?>
                            <p class="card-text text-muted mb-2">
                                <small class="badge bg-danger">
                                    <i class="bi bi-google"></i> Google Account
                                </small>
                            </p>
                        <?php endif; ?>
                        <p class="card-text mb-3"><strong class="text-primary">Your Current Points:</strong> <?php echo e($user->points); ?> Points</p>
                    </div>
                </div>
            </div>

            <!-- Layanan Section -->
            <div class="col-md-8">

                <!-- Testimonials Section -->
                <div class="card shadow-lg border-0 rounded-xl mb-5">
                    <div class="card-header bg-dark text-white text-center font-weight-bold py-3">
                        <h5>Write Your Testimony</h5>
                    </div>
                    <div class="card-body">
                        <form id="reviewForm" class="d-flex flex-column gap-1 justify-content-center">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <textarea class="form-control" name="content" rows="6" placeholder="Write your testimony here..." required><?php echo e($review ? $review->content : ''); ?></textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary text-black btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Redeem Code Section -->
                <div class="col-12">
                    <div class="card shadow-lg border-0 rounded-xl mb-5">
                        <div class="card-header bg-dark text-white text-center font-weight-bold py-3">
                            <h5>Redeem Your Code</h5>
                        </div>
                        <div class="card-body">
                            <form id="redeemForm" class="d-flex justify-content-center">
                                <?php echo csrf_field(); ?>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="code" placeholder="Enter your code here..." required>
                                    <button type="submit" class="btn btn-primary text-black btn-lg">Redeem</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Review form submission
            $('#reviewForm').on('submit', function(event) {
                event.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "<?php echo e(route('user.review.store')); ?>",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '<br>';
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMessage,
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
            });

            // Redeem form submission
            $('#redeemForm').on('submit', function(event) {
                event.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "<?php echo e(route('user.redeem-code')); ?>",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '<br>';
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMessage,
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laragon\www\backoffice_haircut\resources\views/pages/user/dashboard/index.blade.php ENDPATH**/ ?>