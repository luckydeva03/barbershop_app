<?php
    $storeData = [
        'id' => $store->id,
        'name' => $store->name,
        'description' => $store->description ?? 'Professional barbershop services with modern facilities.',
        'address' => $store->address,
        'phone' => $store->phone,
        'hours' => $store->hours,
        'image' => $store->image ?? 'images/stores/default.jpg',
        'latitude' => $store->latitude,
        'longitude' => $store->longitude,
        'badge' => $store->badge ?? 'Premium Location',
        'badge_icon' => $store->badge_icon ?? 'bi-star-fill',
        'maps_url' => $store->maps_url ?? "https://www.google.com/maps?q={$store->latitude},{$store->longitude}"
    ];
?>

<div class="col-lg-4 col-md-6">
    <div class="card h-100 store-card rounded-4" data-store-id="<?php echo e($storeData['id']); ?>">
        <!-- Store Image -->
        <div class="card-img-top position-relative overflow-hidden" style="height: 200px; border-radius: 1rem 1rem 0 0;">
            <img src="<?php echo e(asset($storeData['image'])); ?>" 
                 alt="<?php echo e($storeData['name']); ?>" 
                 class="w-100 h-100 store-image"
                 onerror="this.src='https://via.placeholder.com/400x200/667eea/ffffff?text=Altoz+BarberShop'">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25"></div>
            <div class="position-absolute bottom-0 start-0 p-3">
                <span class="badge bg-primary px-3 py-2 rounded-pill">
                    <i class="bi <?php echo e($storeData['badge_icon']); ?> me-1"></i>
                    <?php echo e($storeData['badge']); ?>

                </span>
            </div>
        </div>
        
        <!-- Store Content -->
        <div class="card-body p-4">
            <h5 class="card-title fw-bold text-dark mb-3"><?php echo e($storeData['name']); ?></h5>
            <p class="card-text text-muted mb-3"><?php echo e($storeData['description']); ?></p>
            
            <!-- Store Information -->
            <div class="store-info">
                <div class="d-flex align-items-start mb-2">
                    <i class="bi bi-geo-alt-fill text-primary me-3 mt-1"></i>
                    <span class="text-muted"><?php echo e($storeData['address']); ?></span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-telephone-fill text-primary me-3"></i>
                    <a href="tel:<?php echo e($storeData['phone']); ?>" class="text-decoration-none text-muted"><?php echo e($storeData['phone']); ?></a>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-clock-fill text-primary me-3"></i>
                    <span class="text-muted"><?php echo e($storeData['hours']); ?></span>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="card-buttons">
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('stores.show', $storeData['id'])); ?>" 
                       class="btn btn-primary rounded-3">
                        <i class="bi bi-info-circle me-2"></i>View Details
                    </a>
                    <a href="<?php echo e($storeData['maps_url']); ?>" 
                       target="_blank" 
                       class="btn btn-outline-success rounded-3">
                        <i class="bi bi-geo-alt me-2"></i>Open in Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\laragon\www\backoffice_haircut\resources\views/components/store-card.blade.php ENDPATH**/ ?>