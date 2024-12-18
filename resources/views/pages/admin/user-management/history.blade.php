@extends('layouts.master')

@section('title', 'History User')
@section('meta-tag')
    <meta name="description" content="Admin Dashboard Overview for Haircut Backoffice">
@endsection

@section('content')
    <div class="container">
        <!-- User Details -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>User Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Name:</strong> {{ $histories->first()?->user->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Email:</strong> {{ $histories->first()?->user->email ?? 'N/A' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Current Points:</strong> {{ $histories->first()?->user->points ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Point History Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Points</th>
                    <th>Before Transaction</th>
                    <th>After Transaction</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($histories as $history)
                    <tr>
                        <td>{{ $loop->iteration + $histories->firstItem() - 1 }}</td>
                        <td>
                            <span class="badge bg-{{ $history->type === 'deposit' ? 'success' : 'danger' }}">
                                {{ ucfirst($history->type) }}
                            </span>
                        </td>
                        <td>{{ $history->points }}</td>
                        <td>{{ $history->before_transaction }}</td>
                        <td>{{ $history->after_transaction }}</td>
                        <td>{{ $history->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No history records found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $histories->links() }}
        </div>
    </div>
@endsection
