@extends('layouts.master')

@section('title', 'Admin Dashboard')
@section('meta-tag')
    <meta name="description" content="Admin Dashboard Overview for Haircut Backoffice">
@endsection

@section('title', 'Admin Dashboard')
@section('subtitle', 'Overview of System Metrics')

@section('content')
    <section class="section">
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

        <!-- Statistics Cards Row -->
        <div class="row g-4 mb-4">
            <!-- Users Metric Card -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100 shadow-sm rounded-4 border-start border-4 border-primary">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="flex-grow-1">
                                <h6 class="card-title text-primary fw-semibold mb-1">Total Users</h6>
                                <h2 class="fw-bold text-primary mb-2">{{ number_format($user) }}</h2>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-person-fill fs-3 text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <p class="card-text text-muted small mb-0">Registered users on platform</p>
                    </div>
                </div>
            </div>

            <!-- Total Redeem Codes Metric Card -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100 shadow-sm rounded-4 border-start border-4 border-info">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="flex-grow-1">
                                <h6 class="card-title text-info fw-semibold mb-1">Total Codes</h6>
                                <h2 class="fw-bold text-info mb-2">{{ number_format($codeRedeem) }}</h2>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-ticket-perforated-fill fs-3 text-info"></i>
                                </div>
                            </div>
                        </div>
                        <p class="card-text text-muted small mb-0">Redeem codes generated</p>
                    </div>
                </div>
            </div>

            <!-- Active Redeem Codes Metric Card -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100 shadow-sm rounded-4 border-start border-4 border-success">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="flex-grow-1">
                                <h6 class="card-title text-success fw-semibold mb-1">Active Codes</h6>
                                <h2 class="fw-bold text-success mb-2">{{ number_format($codeRedeemActive) }}</h2>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                                </div>
                            </div>
                        </div>
                        <p class="card-text text-muted small mb-0">Currently active codes</p>
                    </div>
                </div>
            </div>

            <!-- Total Reviews Metric Card -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100 shadow-sm rounded-4 border-start border-4 border-warning">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="flex-grow-1">
                                <h6 class="card-title text-warning fw-semibold mb-1">Total Reviews</h6>
                                <h2 class="fw-bold text-warning mb-2">{{ number_format($review) }}</h2>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-chat-dots-fill fs-3 text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <p class="card-text text-muted small mb-0">User reviews submitted</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Statistics Row -->
        <div class="row g-4 mb-4">
            <!-- Active Reviews Card -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100 shadow-sm rounded-4 border-start border-4 border-danger">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="flex-grow-1">
                                <h6 class="card-title text-danger fw-semibold mb-1">Approved Reviews</h6>
                                <h2 class="fw-bold text-danger mb-2">{{ number_format($reviewActive) }}</h2>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="bg-danger bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-star-fill fs-3 text-danger"></i>
                                </div>
                            </div>
                        </div>
                        <p class="card-text text-muted small mb-0">Reviews approved & visible</p>
                    </div>
                </div>
            </div>

            <!-- System Overview Card -->
            <div class="col-xl-9 col-lg-6 col-md-6 col-sm-12">
                <div class="card h-100 shadow-sm rounded-4 border-0">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 1rem 1rem 0 0 !important; border: none;">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title text-white mb-0 fw-semibold">System Overview</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 border">
                                    <div class="me-3">
                                        <i class="bi bi-people-fill text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold mb-1 text-dark">User Management</h6>
                                        <p class="text-dark small mb-0">Track and manage all registered users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 border">
                                    <div class="me-3">
                                        <i class="bi bi-gift-fill text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold mb-1 text-dark">Promo Codes</h6>
                                        <p class="text-dark small mb-0">Monitor redeem code performance</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 border">
                                    <div class="me-3">
                                        <i class="bi bi-chat-square-heart-fill text-warning fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold mb-1 text-dark">Review System</h6>
                                        <p class="text-dark small mb-0">Manage customer feedback & reviews</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 border">
                                    <div class="me-3">
                                        <i class="bi bi-shield-fill text-danger fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold mb-1 text-dark">Security</h6>
                                        <p class="text-dark small mb-0">Rate limiting & authentication active</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        console.log('Dashboard loaded successfully');
        
        // Add some interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to cards
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.transition = 'all 0.2s ease-in-out';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection
