<!DOCTYPE html>
<html lang="en">

<head>
    <title>MinimalWangi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

<body>

@include('frontend.home.header')

<div class="container mt-4">
    <h2>Daftar Order Anda</h2>
    @if ($orders->isEmpty())
        <p>Anda belum memiliki order.</p>
    @else
        @foreach ($orders as $order)
            <div class="order-card mb-4">
                
                <div class="order-info">
                    <p><strong>Customer Name:</strong> {{ $order->name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->no_hp }}</p>
                    <p><strong>Address:</strong> {{ $order->alamat }}</p>
                    <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                    <p><strong>Delivery Status:</strong> {{ $order->delivery_status }}</p>
                    <p><strong>No Resi:</strong> {{ $order->no_resi }}</p>
                </div>

                <!-- Order Details Table -->
                <h3>Order Details</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->nama_produk }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>Rp{{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}</td>
                            </tr>
                            @php $total += $detail->harga * $detail->jumlah; @endphp
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>

@include('frontend.home.footer')

 <!-- Start Script -->
 <script src="assets/js/jquery-1.11.0.min.js"></script>
 <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
 <script src="assets/js/bootstrap.bundle.min.js"></script>
 <script src="assets/js/templatemo.js"></script>
 <script src="assets/js/custom.js"></script>
 <!-- End Script -->
</body>
</html>
