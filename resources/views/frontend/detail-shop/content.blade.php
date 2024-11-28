<section class="bg-light">
    <div class="container pb-5">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <!-- Kolom Gambar Produk -->
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="product/{{ $product->image }}" alt="Product Image" id="product-detail">
                </div>
            </div>

            <!-- Kolom Informasi Produk -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <!-- Nama Produk -->
                        <h1 class="h2">{{ $product->nama_produk }}</h1>

                        <!-- Harga Produk -->
                        <p class="h3 py-2">
                            @if($product->diskon && $product->diskon != '0%')
                                <span class="text-muted text-decoration-line-through">
                                    RP. {{ number_format($product->harga, 0, ',', '.') }}
                                </span><br>
                                <span class="text-danger">
                                    RP. {{ number_format($product->harga - ($product->harga * intval($product->diskon) / 100), 0, ',', '.') }}
                                </span>
                            @else
                                <span>
                                    RP. {{ number_format($product->harga, 0, ',', '.') }}
                                </span>
                            @endif
                        </p>

                        <!-- Deskripsi Produk -->
                        <p class="py-2">{{ $product->deskripsi }}</p>

                        <!-- Form untuk Tambah ke Keranjang -->
                        <form action="{{ url('add_cart', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product-title" value="{{ $product->nama_produk }}">
                            <div class="col-auto">
                                <ul class="list-inline pb-3">
                                    <li class="list-inline-item text-right">
                                        Jumlah
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="number" id="manual-quantity" name="product-quantity" class="form-control" style="width: 60px;" placeholder="Qty" min="1">
                                    </li>
                                </ul>
                            </div>
                            <div class="col d-grid">
                                <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocart">Tambah ke Keranjang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
const form = document.querySelector('form');
const manualQuantity = document.getElementById('manual-quantity');

form.addEventListener('submit', function (e) {
    const manualValue = parseInt(manualQuantity.value, 10);

    // Validasi manual
    if (isNaN(manualValue) || manualValue <= 0) {
        e.preventDefault(); // Cegah pengiriman form
        alert('Masukkan jumlah produk yang valid.');
        return;
    }
});
</script>
