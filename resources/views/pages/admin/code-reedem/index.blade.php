@extends('layouts.master')

@section('title', 'Redeem Code Management')
@section('meta-tag')
    <meta name="description" content="Admin Dashboard Overview for Haircut Backoffice">
@endsection

@section('content')
    <div class="container">
        <h1>Code Redeem Management</h1>

        <!-- Filter Form -->
        <form action="{{ route('admin.code-reedem.index') }}" method="GET" class="d-flex gap-2 mb-4">
            <!-- Search by Points or Code -->
            <input type="text" name="search" class="form-control" placeholder="Search by points or code"
                   value="{{ request('search') }}">

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Table Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Points</th>
                    <th>Active</th>
                    <th>User Redeem</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($reedemCodes as $code)
                    <tr data-code-id="{{ $code->id }}">
                        <td>{{ $loop->iteration + $reedemCodes->firstItem() - 1 }}</td>
                        <td>{{ $code->code }}</td>
                        <td>{{ $code->points }}</td>
                        <td>
                            <span class="badge {{ $code->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $code->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $code->user?->name ?? 'N/A' }}</td>
                        <td>{{ $code->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No redemption codes found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $reedemCodes->appends(['search' => request('search')])->links() }}
        </div>

        <!-- Generate New Code Modal -->
        <div class="modal fade" id="generateCodeModal" tabindex="-1" aria-labelledby="generateCodeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="generateCodeModalLabel">Generate New Redemption Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="generateCodeForm">
                            @csrf
                            <div class="mb-3">
                                <label for="points" class="form-label">Points</label>
                                <input type="number" name="points" id="points" class="form-control" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="submitGenerateCode">Generate Code</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button to trigger Generate Code Modal -->
        <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#generateCodeModal">Generate New Code</button>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Trigger the Generate Code Modal
            $('#submitGenerateCode').on('click', function () {
                const formData = $('#generateCodeForm').serialize();
                const url = "{{ route('admin.code-reedem.store') }}";

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        }).then(() => {
                            $('#generateCodeModal').modal('hide');
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        const errorMessage = xhr.responseJSON?.message || 'Something went wrong';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    }
                });
            });

            // Delete Code with Confirmation
            $('.btn-delete').on('click', function () {
                const codeId = $(this).closest('tr').data('code-id');
                const url = `/sudut-potong/admin/code-reedem/delete-code/${codeId}`;

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This code will be deleted permanently.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function (xhr) {
                                const errorMessage = xhr.responseJSON?.message || 'Something went wrong';
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: errorMessage,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        confirmButton: 'btn btn-danger'
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
