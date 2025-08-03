

<?php $__env->startSection('title', $store['name'] . ' - Altoz BarberShop'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid" style="margin-top: 100px;">
    <!-- Store Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="position-relative" style="height: 400px;">
                            <img src="<?php echo e(asset($store['image'])); ?>" 
                                 alt="<?php echo e($store['name']); ?>" 
                                 class="w-100 h-100 object-fit-cover"
                                 onerror="this.src='https://via.placeholder.com/600x400/667eea/ffffff?text=Altoz+BarberShop'">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-5 h-100 d-flex flex-column justify-content-center">
                            <h1 class="display-6 fw-bold text-primary mb-3"><?php echo e($store['name']); ?></h1>
                            <p class="lead text-muted mb-4"><?php echo e($store['description']); ?></p>
                            
                            <div class="store-details">
                                <div class="d-flex align-items-start mb-3">
                                    <i class="bi bi-geo-alt-fill text-danger me-3 fs-5"></i>
                                    <div>
                                        <h6 class="fw-semibold mb-1">Address</h6>
                                        <p class="text-muted mb-0"><?php echo e($store['address']); ?></p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-telephone-fill text-success me-3 fs-5"></i>
                                    <div>
                                        <h6 class="fw-semibold mb-1">Phone</h6>
                                        <p class="text-muted mb-0"><?php echo e($store['phone']); ?></p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-clock-fill text-warning me-3 fs-5"></i>
                                    <div>
                                        <h6 class="fw-semibold mb-1">Operating Hours</h6>
                                        <p class="text-muted mb-0"><?php echo e($store['hours']); ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-3">
                                <a href="<?php echo e(route('booking.index')); ?>" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-calendar-check me-2"></i>
                                    Book Appointment
                                </a>
                                <button class="btn btn-outline-primary btn-lg px-4" onclick="showDirections()">
                                    <i class="bi bi-navigation me-2"></i>
                                    Get Directions
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient text-white text-center py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 1rem 1rem 0 0 !important;">
                    <h4 class="mb-0 fw-semibold">
                        <i class="bi bi-map me-2"></i>
                        Store Location
                    </h4>
                </div>
                <div class="card-body p-0">
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="fw-bold text-primary mb-4 text-center">Available Services</h3>
                    <div class="row g-4">
                        <?php $__currentLoopData = $store['services']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="d-flex align-items-center p-3 bg-light rounded-3 h-100">
                                <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                                <h6 class="mb-0 fw-semibold"><?php echo e($service); ?></h6>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5 text-center">
                    <h3 class="fw-bold text-primary mb-4">Get in Touch</h3>
                    <p class="lead text-muted mb-4">Ready to experience premium grooming? Contact us or book your appointment now!</p>
                    
                    <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                            <a href="tel:<?php echo e($store['phone']); ?>" class="btn btn-outline-success btn-lg">
                                <i class="bi bi-telephone me-2"></i>
                                Call Now
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="<?php echo e(route('booking.quick')); ?>" class="btn btn-success btn-lg">
                                <i class="bi bi-whatsapp me-2"></i>
                                WhatsApp
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="<?php echo e(route('booking.index')); ?>" class="btn btn-primary btn-lg">
                                <i class="bi bi-calendar-check me-2"></i>
                                Book Online
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    let map;
    let marker;
    
    // Store data from PHP
    const store = <?php echo json_encode($store, 15, 512) ?>;
    const apiKey = <?php echo json_encode($googleMapsApiKey, 15, 512) ?>;

    function initMap() {
        const storePosition = { lat: store.latitude, lng: store.longitude };
        
        // Initialize map
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: storePosition,
            styles: [
                {
                    featureType: 'poi',
                    elementType: 'labels',
                    stylers: [{ visibility: 'off' }]
                }
            ]
        });

        // Add marker for the store
        marker = new google.maps.Marker({
            position: storePosition,
            map: map,
            title: store.name,
            icon: {
                url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="#667eea">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                `),
                scaledSize: new google.maps.Size(50, 50),
                anchor: new google.maps.Point(25, 50)
            }
        });

        // Create info window
        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div style="max-width: 300px;">
                    <h6 class="fw-bold text-primary mb-2">${store.name}</h6>
                    <p class="mb-2 small">${store.address}</p>
                    <p class="mb-2 small"><i class="bi bi-telephone-fill text-success me-1"></i> ${store.phone}</p>
                    <p class="mb-3 small"><i class="bi bi-clock-fill text-warning me-1"></i> ${store.hours}</p>
                    <div>
                        <a href="/booking" class="btn btn-primary btn-sm">Book Now</a>
                    </div>
                </div>
            `
        });

        // Show info window when marker is clicked
        marker.addListener('click', () => {
            infoWindow.open(map, marker);
        });

        // Auto-open info window
        setTimeout(() => {
            infoWindow.open(map, marker);
        }, 1000);
    }

    // Show directions to the store
    function showDirections() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                const storeAddress = encodeURIComponent(store.address);
                
                // Open Google Maps with directions
                const url = `https://www.google.com/maps/dir/${userLat},${userLng}/${storeAddress}`;
                window.open(url, '_blank');
            }, function() {
                // Fallback: just open store location
                const storeAddress = encodeURIComponent(store.address);
                const url = `https://www.google.com/maps/search/${storeAddress}`;
                window.open(url, '_blank');
            });
        } else {
            // Fallback: just open store location
            const storeAddress = encodeURIComponent(store.address);
            const url = `https://www.google.com/maps/search/${storeAddress}`;
            window.open(url, '_blank');
        }
    }

    // Load Google Maps API
    function loadGoogleMaps() {
        if (typeof google !== 'undefined') {
            initMap();
            return;
        }
        
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap`;
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', loadGoogleMaps);
</script>

<style>
    .object-fit-cover {
        object-fit: cover;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.booking', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laragon\www\backoffice_haircut\resources\views/pages/stores/show.blade.php ENDPATH**/ ?>