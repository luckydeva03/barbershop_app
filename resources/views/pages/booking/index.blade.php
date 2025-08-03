@extends('layouts.booking')

@section('title', 'Book Appointment - Altoz BarberShop')

@section('content')
<div class="container-fluid" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 1rem 1rem 0 0 !important;">
                    <h2 class="mb-0 fw-bold">
                        <i class="bi bi-scissors me-2"></i>
                        Book Your Appointment
                    </h2>
                    <p class="mb-0 mt-2 opacity-75">Experience premium grooming at Altoz BarberShop</p>
                </div>
                
                <div class="card-body p-5">
                    <!-- Quick Book Button -->
                    <div class="text-center mb-4">
                        <a href="{{ route('booking.quick') }}" class="btn btn-success btn-lg rounded-pill px-5 py-3 shadow-sm">
                            <i class="bi bi-whatsapp me-2"></i>
                            Quick Book via WhatsApp
                        </a>
                        <p class="text-muted mt-2 small">Or fill the form below for detailed booking</p>
                    </div>

                    <hr class="my-4">

                    <!-- Booking Form -->
                    <form action="{{ route('booking.whatsapp') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Personal Information -->
                            <div class="col-12">
                                <h5 class="text-primary fw-semibold mb-3">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Personal Information
                                </h5>
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">Full Name *</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" 
                                       placeholder="Enter your full name" required>
                                <div class="invalid-feedback">Please provide your name.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                <input type="tel" class="form-control form-control-lg" id="phone" name="phone" 
                                       placeholder="08xxxxxxxxxx">
                                <small class="text-muted">Optional - for confirmation</small>
                            </div>

                            <!-- Service Selection -->
                            <div class="col-12 mt-4">
                                <h5 class="text-primary fw-semibold mb-3">
                                    <i class="bi bi-scissors me-2"></i>
                                    Service Selection
                                </h5>
                            </div>

                            <div class="col-12">
                                <label for="service" class="form-label fw-semibold">Choose Service *</label>
                                <select class="form-select form-select-lg" id="service" name="service" required>
                                    <option value="">Select a service...</option>
                                    <option value="Premium Haircut">Premium Haircut</option>
                                    <option value="Haircut + Beard Trim">Haircut + Beard Trim</option>
                                    <option value="Beard Trim Only">Beard Trim Only</option>
                                    <option value="Hair Wash + Styling">Hair Wash + Styling</option>
                                    <option value="Complete Grooming Package">Complete Grooming Package</option>
                                    <option value="Kids Haircut">Kids Haircut</option>
                                </select>
                                <div class="invalid-feedback">Please select a service.</div>
                            </div>

                            <!-- Date and Time -->
                            <div class="col-12 mt-4">
                                <h5 class="text-primary fw-semibold mb-3">
                                    <i class="bi bi-calendar-event me-2"></i>
                                    Preferred Schedule
                                </h5>
                            </div>

                            <div class="col-md-6">
                                <label for="date" class="form-label fw-semibold">Preferred Date *</label>
                                <input type="date" class="form-control form-control-lg" id="date" name="date" 
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                <div class="invalid-feedback">Please select a date.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="time" class="form-label fw-semibold">Preferred Time *</label>
                                <select class="form-select form-select-lg" id="time" name="time" required>
                                    <option value="">Select time...</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                </select>
                                <div class="invalid-feedback">Please select a time.</div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 mt-5 text-center">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow-sm">
                                    <i class="bi bi-whatsapp me-2"></i>
                                    Book via WhatsApp
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        You will be redirected to WhatsApp to confirm your booking
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Service Info Section -->
<div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-12 mb-4">
                <h3 class="fw-bold text-primary">Why Choose Altoz BarberShop?</h3>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-award text-primary fs-1 mb-3"></i>
                        <h5 class="fw-semibold">Premium Quality</h5>
                        <p class="text-muted">Professional barbers with years of experience</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-clock text-primary fs-1 mb-3"></i>
                        <h5 class="fw-semibold">Flexible Hours</h5>
                        <p class="text-muted">Open 7 days a week for your convenience</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-shield-check text-primary fs-1 mb-3"></i>
                        <h5 class="fw-semibold">Hygiene First</h5>
                        <p class="text-muted">Clean and sanitized equipment for safety</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Set minimum date to tomorrow
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        const year = tomorrow.getFullYear();
        const month = String(tomorrow.getMonth() + 1).padStart(2, '0');
        const day = String(tomorrow.getDate()).padStart(2, '0');
        
        dateInput.min = `${year}-${month}-${day}`;
    });
</script>
@endsection
