@extends('layouts.customer')

@section('content')
    <div class="container py-3">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-4 mb-5">
                <div class="card shadow-lg border-0 rounded-xl overflow-hidden">
                    <div class="card-body text-center">
                        <!-- Profile Image with elegant frame -->
                        <img src="https://via.placeholder.com/150" class="img-fluid rounded-circle mb-3 border border-dark" alt="Profile Image" style="width: 150px; height: 150px;">
                        <h4 class="card-title font-weight-bold text-dark mb-2">Agung Dwi</h4>
                        <p class="card-text text-muted mb-2"><strong>Email:</strong> test@example.com</p>
                        <p class="card-text mb-3"><strong class="text-primary">Points:</strong> 80 Points</p>
                    </div>
                </div>
            </div>

            <!-- Layanan Section -->
            <div class="col-md-8">

                <!-- Testimonials Section -->
                <div class="card shadow-lg border-0 rounded-xl mb-5">
                    <div class="card-header bg-dark text-white text-center font-weight-bold py-3">
                        <h5>What Our Clients Say</h5>
                    </div>
                    <div class="card-body">
                        <div class="testimonial">
                            <p class="text-muted">"Best haircut I’ve ever had! The service was excellent and the ambiance is very relaxing."</p>
                            <p class="font-weight-bold text-dark">John Doe</p>
                            <p class="small text-muted">Regular Client</p>
                        </div>
                        <div class="testimonial mt-3">
                            <p class="text-muted">"The staff is friendly, and they really know how to make you feel at home. Highly recommend!"</p>
                            <p class="font-weight-bold text-dark">Jane Smith</p>
                            <p class="small text-muted">VIP Member</p>
                        </div>
                    </div>
                </div>

                <!-- Special Offers -->
                <div class="card shadow-lg border-0 rounded-xl mb-5">
                    <div class="card-header bg-dark text-white text-center font-weight-bold py-3">
                        <h5>Special Offers & Promotions</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                <span class="font-weight-bold text-dark">20% Off on Your Next Haircut</span>
                                <span class="badge badge-pill badge-primary">Active</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                <span class="font-weight-bold text-dark">50 Points for Every Referral</span>
                                <span class="badge badge-pill badge-secondary">Ongoing</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                <span class="font-weight-bold text-dark">Free Styling Product with Premium Haircut</span>
                                <span class="badge badge-pill badge-success">Available</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
