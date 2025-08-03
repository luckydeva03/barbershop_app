<?php $__env->startSection('content'); ?>
    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                <!-- History Transaksi Point Section -->
                <div class="card shadow-lg border-0 rounded-xl mb-5">
                    <div class="card-header bg-dark text-white text-center font-weight-bold py-3">
                        <h5>History Transaksi Point</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Status</th>
                                <th scope="col">Before</th>
                                <th scope="col">After</th>
                                <th scope="col">Point</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td>
                                        <?php if($transaction->type == 'deposit'): ?>
                                            <span class="badge bg-success">Point Masuk</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Point Keluar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($transaction->before_transaction); ?> Poin</td>
                                    <td><?php echo e($transaction->after_transaction); ?> Poin</td>
                                    <td><?php echo e($transaction->points); ?> Poin</td>
                                    <td><?php echo e($transaction->created_at->format('d M Y, H:i')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laragon\www\backoffice_haircut\resources\views/pages/user/history/index.blade.php ENDPATH**/ ?>