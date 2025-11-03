@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4 text-light">Transaction Report</h1>

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Barcode</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->product->name }}</td>
                    <td>{{ $transaction->barcode }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
