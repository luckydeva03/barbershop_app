@extends('layouts.master')

@section('title', 'Admin Dashboard')
@section('meta-tag')
    <meta name="description" content="Admin Dashboard Overview for Haircut Backoffice">
@endsection

@section('title', 'Admin Dashboard')
@section('subtitle', 'Overview of System Metrics')

@section('content')
    <section class="section">
        <div class="row">
            <!-- Users Metric Card -->
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card shadow-lg rounded-3 border-start border-5 border-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-primary">Total Users</h5>
                            <i class="bi bi-person-fill display-6 text-primary"></i>
                        </div>
                        <h3 class="fw-bold">{{ $user }}</h3>
                        <p class="card-text text-muted">The total number of users registered on the platform.</p>
                    </div>
                </div>
            </div>

            <!-- Redeem Codes Metric Card -->
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card shadow-lg rounded-3 border-start border-5 border-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-info">Total Redeem Codes</h5>
                            <i class="bi bi-cash-stack display-6 text-info"></i>
                        </div>
                        <h3 class="fw-bold">{{ $codeRedeem }}</h3>
                        <p class="card-text text-muted">The total number of redeem codes generated in the system.</p>
                    </div>
                </div>
            </div>

            <!-- Active Redeem Codes Metric Card -->
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card shadow-lg rounded-3 border-start border-5 border-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-success">Active Redeem Codes</h5>
                            <i class="bi bi-check-circle-fill display-6 text-success"></i>
                        </div>
                        <h3 class="fw-bold">{{ $codeRedeemActive }}</h3>
                        <p class="card-text text-muted">Number of redeem codes that are currently active.</p>
                    </div>
                </div>
            </div>

            <!-- Reviews Metric Card -->
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card shadow-lg rounded-3 border-start border-5 border-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-warning">Total Reviews</h5>
                            <i class="bi bi-chat-dots-fill display-6 text-warning"></i>
                        </div>
                        <h3 class="fw-bold">{{ $review }}</h3>
                        <p class="card-text text-muted">The total number of reviews submitted by users.</p>
                    </div>
                </div>
            </div>

            <!-- Active Reviews Metric Card -->
            <div class="col-xl-3 col-md-6 col-sm-12 mt-4">
                <div class="card shadow-lg rounded-3 border-start border-5 border-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-success">Active Reviews</h5>
                            <i class="bi bi-star-fill display-6 text-success"></i>
                        </div>
                        <h3 class="fw-bold">{{ $reviewActive }}</h3>
                        <p class="card-text text-muted">Reviews that have been approved and are visible to others.</p>
                    </div>
                </div>
            </div>

            <!-- Summary Section (take remaining space) -->
            <div class="col-xl-9 col-md-12 mt-4">
                <div class="card shadow-lg rounded-3">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title">Overview of Key Metrics</h4>
                    </div>
                    <div class="card-body">
                        <p>This dashboard provides an overview of the platform’s essential metrics. It gives admins a quick view of total users, redeem codes, and reviews, allowing for informed decision-making. You can track the progress of active codes and reviews as well.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        console.log('Dashboard loaded successfully');
    </script>
@endsection
