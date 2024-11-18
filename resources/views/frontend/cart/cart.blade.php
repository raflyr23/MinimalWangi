<!DOCTYPE html>
<html lang="en">
<head>
    <title>MinimalWangi - Cart</title>
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

    <div class="container my-5">
        <div class="row">
            <!-- Cart Header -->
            <div class="col-12 text-center mb-4">
                <h2 class="cart-header">Your Cart</h2>
            </div>

            <!-- Cart Table -->
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @forelse ($cart as $item)
                            <tr>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>RP. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    <img src="product/{{ $item->image }}" alt="{{ $item->nama_produk }}" class="img-fluid product-img" style="max-width: 80px;">
                                </td>
                                <td class="action-btn">
                                    <form action="{{ url('remove_cart', $item->id) }}" method="GET">
                                        @csrf
                                        @method('get')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $total += $item->harga * $item->jumlah;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="5" class="empty-cart-message text-center">Your cart is empty!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Total Price and Checkout Button -->
            @if($total > 0)
            <div class="col-12 text-right">
                <div class="total-price mb-4">
                    <strong>Total Price: RP. {{ number_format($total, 0, ',', '.') }}</strong>
                </div>
                <a href="{{ route('order.details') }}" class="btn btn-primary btn-lg">Lihat Detail Pemesanan</a>
            </div>
            @endif
        </div>
    </div>

    @include('frontend.home.footer')

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
