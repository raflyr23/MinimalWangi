<!DOCTYPE html>
<html lang="id">
<head>
    <title>MinimalWangi - Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>
<body>
    <!-- Header -->
    @include('frontend.home.header')

    <!-- Bagian Checkout -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Checkout</h2>

        <!-- Form Detail Pengguna -->
        <form id="checkout-form" action="{{ url('/confirm_payment') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <!-- Checkbox untuk opsi 'Sama seperti profil' -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="sameAsAccount" onclick="fillFromAccount()">
                <label class="form-check-label" for="sameAsAccount">Isi dengan data profil</label>
            </div>
        
            <!-- Detail Pengguna -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" class="form-control" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                </div>
            </div>
        
            <!-- Detail Pesanan -->
            <h4>Detail Pesanan</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Gambar</th>
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
                <strong>Total Harga: RP. {{ number_format($total, 0, ',', '.') }}</strong>
            </div>

            <!-- Tombol Checkout -->
            <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#paymentModal">Checkout</button>

            <!-- Modal Pembayaran -->
            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Pilih Metode Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Bank Jago<br>2211102265<br>an/raflyromeo</p>
                            <br>
                            <label class="form-label" for="customFile">Unggah Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="customFile" name="image" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Konfirmasi dan Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    @include('frontend.home.footer')

    <!-- Scripts -->
    <script>
        // Script untuk mengisi otomatis data dari profil
        function fillFromAccount() {
            const isChecked = document.getElementById('sameAsAccount').checked;
    
            if (isChecked) {
                document.getElementById('name').value = "{{ $user->name }}";
                document.getElementById('no_telp').value = "{{ $user->no_telp }}";
                document.getElementById('alamat').value = "{{ $user->alamat }}";
            } else {
                document.getElementById('name').value = '';
                document.getElementById('no_telp').value = '';
                document.getElementById('alamat').value = '';
            }
        }
    </script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
