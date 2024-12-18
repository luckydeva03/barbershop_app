@extends('layouts.master')

@section('title', 'User Management')
@section('meta-tag')
    <meta name="description" content="Admin Dashboard Overview for Haircut Backoffice">
@endsection

@section('content')
    <div class="container">
        <!-- Filter -->
        <form action="{{ route('admin.user-management.index') }}" method="GET" class="d-flex gap-2 mb-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email"
                   value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Points</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->points }}</td>
                        <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <button onclick="window.location.href='{{ route('admin.user-management.history', ['userId' => $user->id]) }}'" class="btn btn-sm btn-warning">History</button>
                            <button class="btn btn-sm btn-success btn-add-point"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}">Add Point</button>
                            <button class="btn btn-sm btn-danger btn-delete"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No users found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $users->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <!-- Add Point Modal -->
    <div class="modal fade" id="addPointModal" tabindex="-1" aria-labelledby="addPointModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPointModalLabel">Add Point</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPointForm">
                        @csrf
                        <div class="mb-3">
                            <label for="user_name" class="form-label">User</label>
                            <input type="text" id="user_name" class="form-control" disabled>
                            <input type="hidden" name="user_id" id="user_id">
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="deposit">Deposit</option>
                                <option value="withdrawal">Withdrawal</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="points" class="form-label">Points</label>
                            <input type="number" name="points" id="points" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="submitAddPoint">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Trigger modal on "Add Point" button click
            $('.btn-add-point').on('click', function () {
                const userId = $(this).data('id');
                const userName = $(this).data('name');

                $('#user_id').val(userId);
                $('#user_name').val(userName);

                $('#addPointModal').modal('show');
            });

            // Handle Delete User
            $('.btn-delete').on('click', function () {
                const userId = $(this).data('id');
                const userName = $(this).data('name');

                // Konfirmasi dengan SweetAlert2
                Swal.fire({
                    title: `Are you sure you want to delete ${userName}?`,
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim request DELETE menggunakan AJAX
                        $.ajax({
                            url: `{{ url('sudut-potong/admin/user-management/user-delete') }}/${userId}`,
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
                                    location.reload();  // Reload halaman setelah sukses
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

            $('#submitAddPoint').on('click', function () {
                const formData = $('#addPointForm').serialize();
                const url = "{{ route('admin.user-management.store-point') }}";

                $(this).prop('disabled', true);

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
                            $('#addPointModal').modal('hide');
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON?.errors || {};
                        let errorMessage = xhr.responseJSON?.message || 'Something went wrong';

                        if (Object.keys(errors).length > 0) {
                            errorMessage += '\n' + Object.values(errors).join('\n');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    },
                    complete: function () {
                        $('#submitAddPoint').prop('disabled', false); // Re-enable button
                    },
                });
            });
        });
    </script>
@endpush


