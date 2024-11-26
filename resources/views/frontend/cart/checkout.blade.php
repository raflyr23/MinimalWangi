<!DOCTYPE html>
<html lang="en">
<head>
    <title>MinimalWangi - Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
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
        <h2 class="text-center mb-4">Checkout</h2>

        <!-- User Details -->
        <form action="{{ route('order.payment') }}" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="col-md-6">
                    <label for="no_telp">Phone Number</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ $user->no_telp }}" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <label for="alamat">Address</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ $user->alamat }}</textarea>
                </div>
            </div>

            <!-- Order Details -->
            <h4>Order Details</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                    <tr>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>RP. {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>RP. {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                        <td>
                            <img src="product/{{ $item->image }}" alt="{{ $item->nama_produk }}" class="img-fluid" style="max-width: 80px;">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                <strong>Total Price: RP. {{ number_format($total, 0, ',', '.') }}</strong>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-4">Checkout</button>
        </form>

    </div>

    @include('frontend.home.footer')
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
