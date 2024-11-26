<!DOCTYPE html>
<html lang="en">
<head>
    <title>MinimalWangi - Payment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    @include('frontend.home.header')

    <div class="container my-5">
        <h2 class="text-center mb-4">Payment</h2>

        <!-- Order Details -->
        <h4>Order Summary</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->nama_produk }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>RP. {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>RP. {{ number_format($item->total_price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <strong>Total: RP. {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
        </div>

        <!-- User Details -->
        <h4 class="mt-4">User Details</h4>
        <ul>
            <li><strong>Name:</strong> {{ $order->name }}</li>
            <li><strong>Phone:</strong> {{ $order->no_telp }}</li>
            <li><strong>Address:</strong> {{ $order->alamat }}</li>
        </ul>

        <!-- Payment Options -->
        <div class="mt-5">
            <h4>Select Payment Method</h4>
            <form action="#" method="POST">
                @csrf
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" value="credit_card" required>
                    <label class="form-check-label">Credit Card</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" value="bank_transfer" required>
                    <label class="form-check-label">Bank Transfer</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Proceed to Payment</button>
            </form>
        </div>
    </div>

    @include('frontend.home.footer')
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
