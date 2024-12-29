@extends('layouts.customer')

@section('content')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                <!-- History Transaksi Point Section -->
                <div class="card shadow-lg border-0 rounded-xl mb-5">
                    <div class="card-header bg-dark text-white text-center font-weight-bold py-3">
                        <h5>History Transaksi Point</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Status</th>
                                <th scope="col">Before</th>
                                <th scope="col">After</th>
                                <th scope="col">Point</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($histories as $index => $transaction)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($transaction->type == 'deposit')
                                            <span class="badge bg-success">Point Masuk</span>
                                        @else
                                            <span class="badge bg-danger">Point Keluar</span>
                                        @endif
                                    </td>
                                    <td>{{ $transaction->before_transaction }} Poin</td>
                                    <td>{{ $transaction->after_transaction }} Poin</td>
                                    <td>{{ $transaction->points }} Poin</td>
                                    <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
