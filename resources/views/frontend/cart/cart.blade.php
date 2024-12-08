<!DOCTYPE html>
<html lang="id">
<head>
    <title>MinimalWangi - Keranjang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Memuat font setelah layout selesai -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

</head>
<body>
    @include('frontend.shop.header')
{{-- Pesan jika barang ingin dihapus dari kerajanng --}}
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>


    <div class="container my-5">
        <div class="row">
            <!-- Header Keranjang -->
            <div class="col-12 text-center mb-4">
                <h2 class="cart-header">Keranjang Anda</h2>
            </div>

            <!-- Tabel Keranjang -->
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
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
                                    <img src="product/{{ $item->image }}" alt="{{ $item->nama_produk }}" class="img-fluid cartproduct-img" style="max-width: 80px;">
                                </td>
                                <td class="action-btn">
                                    <form action="{{ url('remove_cart', $item->id) }}" method="GET" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('get')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                                
                            </tr>
                            @php
                                $total += $item->harga * $item->jumlah;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="5" class="empty-cart-message text-center">Keranjang Anda kosong!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Total Harga dan Tombol Checkout -->
            @if($total > 0)
            <div class="col-12 text-right">
                <div class="total-price mb-4">
                    <strong>Total Harga: RP. {{ number_format($total, 0, ',', '.') }}</strong>
                </div>
                <a href="{{ route('order.details') }}" class="btn btn-success btn-lg">Lihat Detail Pemesanan</a>
            </div>
            @endif
        </div>
    </div>

    @include('frontend.home.footer')

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>

    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus barang dari keranjang?');
        }
    </script>
</body>
</html>
