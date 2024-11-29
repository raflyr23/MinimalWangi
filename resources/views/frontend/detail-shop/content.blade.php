<section class="bg-light py-5">
    <div class="container">
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
                    <img class="card-img img-fluid" src="product/{{ $product->image }}" alt="Gambar Produk" id="product-detail">
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

                        <!-- Form Tambah ke Keranjang -->
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
                                <button type="submit" class="btn btn-success btn-lg">Tambah ke Keranjang</button>
                            </div>
                        </form>
                    </div>

                    <!-- Ulasan Produk -->
                    <div class="product-reviews mt-4">
                        <h3>Ulasan Pelanggan</h3>
                        @if($product->reviews->count() > 0)
                            @foreach($product->reviews as $review)
                            <div class="review-item border-bottom py-3">
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}">★</span>
                                    @endfor
                                </div>
                                <p class="mb-1">{{ $review->comment }}</p>
                                <small class="text-muted">Oleh {{ $review->user->name }} pada {{ $review->created_at->format('M d, Y') }}</small>
                            </div>
                            @endforeach
                        @else
                            <p>Belum ada ulasan.</p>
                        @endif
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

    // Validasi input jumlah
    if (isNaN(manualValue) || manualValue <= 0) {
        e.preventDefault(); // Mencegah pengiriman form
        alert('Masukkan jumlah produk yang valid.');
        return;
    }
});
</script>
