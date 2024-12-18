@extends('layouts.master')

@section('title', 'Review Management')
@section('meta-tag')
    <meta name="description" content="Admin Dashboard Overview for Haircut Backoffice">
@endsection

@section('content')
    <div class="container">
        <h1>Review Management</h1>

        <!-- Filter Form -->
        <form action="{{ route('admin.review.index') }}" method="GET" class="d-flex gap-2 mb-4">
            <!-- Search by Content -->
            <input type="text" name="search" class="form-control" placeholder="Search by review content"
                   value="{{ request('search') }}">

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Table Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Review Content</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($reviews as $review)
                    <tr>
                        <td>{{ $loop->iteration + $reviews->firstItem() - 1 }}</td>
                        <td>{{ $review->user?->name ?? 'N/A' }}</td>
                        <td>{{ $review->content }}</td>
                        <td>{{ $review->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <span class="badge {{ $review->is_approved ? 'bg-success' : 'bg-secondary' }}">
                                {{ $review->is_approved ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.review.toggle-approval', $review->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-{{ $review->is_approved ? 'warning' : 'success' }}">
                                    {{ $review->is_approved ? 'Unapprove' : 'Approve' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No reviews found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $reviews->appends(['search' => request('search')])->links() }}
        </div>
    </div>
@endsection
