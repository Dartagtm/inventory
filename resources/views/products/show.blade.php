@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4 text-light">Product Details: {{ $product->name }}</h1>

        <!-- Transaction Form -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4>Record Product Transaction</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('products.recordTransaction', $product->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Transaction Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="in">In (Stock In)</option>
                            <option value="out">Out (Stock Out)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Record Transaction</button>
                </form>
            </div>
        </div>

        <!-- Shipment Form -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Record Product Shipment</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('products.recordShipment', $product->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
                    </div>

                    <div class="mb-3">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" name="destination" id="destination" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Record Shipment</button>
                </form>
            </div>
        </div>
    </div>
@endsection
