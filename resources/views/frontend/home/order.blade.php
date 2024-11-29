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

<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Order Anda</h2>
    
    @if ($orders->isEmpty())
        <p class="text-center">Anda belum memiliki order.</p>
    @else
        @foreach ($orders as $order)
            <div class="order-card mb-4 p-4 shadow-lg rounded-lg border">
                <div class="order-info mb-4">
                    <h4>Order Details</h4>
                    <p><strong>Customer Name:</strong> {{ $order->name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->no_hp }}</p>
                    <p><strong>Address:</strong> {{ $order->alamat }}</p>
                    <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                    <p><strong>Delivery Status:</strong> {{ $order->delivery_status }}</p>
                    <p><strong>No Resi:</strong> {{ $order->no_resi }}</p>
                </div>

                <h3>Order Items</h3>
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

                @if($order->delivery_status === 'Selesai')
                    @foreach($order->orderDetails as $detail)
                        @if($detail->product && !$detail->product->reviews()->where('user_id', Auth::id())->where('order_id', $order->id)->exists())
                            <div class="review-form mt-3">
                                <h4>Review for {{ $detail->nama_produk }}</h4>
                                <form action="{{ route('review.submit') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $detail->product_id }}">
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    
                                    <div class="rating">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}_{{ $detail->id }}">
                                            <label for="star{{ $i }}_{{ $detail->id }}">☆</label>
                                        @endfor
                                    </div>
                                    
                                    <div class="form-group">
                                        <textarea name="comment" class="form-control" placeholder="Write your review here..."></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success text-white mt-2">Submit Review</button>
                                </form>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        @endforeach
    @endif
</div>

@include('frontend.home.footer')

<script src="assets/js/jquery-1.11.0.min.js"></script>
<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>
