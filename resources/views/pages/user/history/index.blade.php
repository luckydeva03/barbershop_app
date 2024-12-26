<!-- resources/views/dashboard/history.blade.php -->
@extends('layouts.customer')

@section('content')
    <div class="container">
        <div class="card p-4">
            <div class="card-header">Transaction History</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Points</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    @foreach($transactions as $transaction)--}}
                    {{--                        <tr>--}}
                    {{--                            <td>{{ $transaction->date }}</td>--}}
                    {{--                            <td>{{ $transaction->description }}</td>--}}
                    {{--                            <td>{{ $transaction->points }}</td>--}}
                    {{--                        </tr>--}}
                    {{--                    @endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
