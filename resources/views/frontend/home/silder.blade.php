<!-- Start Discounted Products -->
<section class="container-fluid discount-section py-5">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="section-title position-relative mb-4">
                    <span class="bg-white px-3">Produk Diskon Spesial</span>
                </h2>
                <p class="text-muted">Penawaran terbaik minggu ini dengan diskon menarik</p>
            </div>
        </div>
        
        <!-- Carousel Section -->
        <div class="row">
            <div class="col-12 position-relative">
                <div id="discountCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- First Slide -->
                        <div class="carousel-item active">
                            <div class="row g-4">
                                @php
                                    $discountedProducts = $product->where('diskon', '!=', '0%')
                                        ->sortByDesc(function($product) {
                                            return intval($product->diskon);
                                        })
                                        ->take(4);
                                @endphp
                                @foreach($discountedProducts as $item)
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="product-card h-100">
                                        <div class="position-relative overflow-hidden">
                                            <!-- Discount Badge -->
                                            <div class="discount-badge">
                                                <span>-{{ $item->diskon }}%</span>
                                            </div>
                                            
                                            <!-- Product Image -->
                                            <img class="product-img" src="product/{{ $item->image }}" alt="{{ $item->nama_produk }}">
                                            
                                            <!-- Overlay Actions -->
                                            <div class="product-action">
                                                <a class="btn btn-quick-view" href="{{ url('product_details', $item->id) }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                @if($item->jumlah > 0)
                                                <form action="{{ url('add_cart', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-add-cart">
                                                        <i class="fas fa-cart-plus"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Product Details -->
                                        <div class="product-details p-3">
                                            <h5 class="product-title">
                                                <a href="{{ url('product_details', $item->id) }}">{{ $item->nama_produk }}</a>
                                            </h5>
                                            
                                            <!-- Stock Status -->
                                            @if($item->jumlah <= 0)
                                                <div class="stock-status out">Stok Habis</div>
                                            @else
                                                <div class="stock-status in">Stok: {{ $item->jumlah }}</div>
                                            @endif
                                            
                                            <!-- Price -->
                                            <div class="product-price">
                                                <span class="old-price">RP {{ number_format($item->harga, 0, ',', '.') }}</span>
                                                <span class="new-price">RP {{ number_format($item->harga - ($item->harga * intval($item->diskon) / 100), 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Second Slide -->
                        <div class="carousel-item">
                            <div class="row g-4">
                                @php
                                    $discountedProducts = $product->where('diskon', '!=', '0%')
                                        ->sortByDesc(function($product) {
                                            return intval($product->diskon);
                                        })
                                        ->skip(4)
                                        ->take(4);
                                @endphp
                                @foreach($discountedProducts as $item)
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="product-card h-100">
                                        <div class="position-relative overflow-hidden">
                                            <!-- Discount Badge -->
                                            <div class="discount-badge">
                                                <span>-{{ $item->diskon }}%</span>
                                            </div>
                                            
                                            <!-- Product Image -->
                                            <img class="product-img" src="product/{{ $item->image }}" alt="{{ $item->nama_produk }}">
                                            
                                            <!-- Overlay Actions -->
                                            <div class="product-action">
                                                <a class="btn btn-quick-view" href="{{ url('product_details', $item->id) }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                @if($item->jumlah > 0)
                                                <form action="{{ url('add_cart', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-add-cart">
                                                        <i class="fas fa-cart-plus"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Product Details -->
                                        <div class="product-details p-3">
                                            <h5 class="product-title">
                                                <a href="{{ url('product_details', $item->id) }}">{{ $item->nama_produk }}</a>
                                            </h5>
                                            
                                            <!-- Stock Status -->
                                            @if($item->jumlah <= 0)
                                                <div class="stock-status out">Stok Habis</div>
                                            @else
                                                <div class="stock-status in">Stok: {{ $item->jumlah }}</div>
                                            @endif
                                            
                                            <!-- Price -->
                                            <div class="product-price">
                                                <span class="old-price">RP {{ number_format($item->harga, 0, ',', '.') }}</span>
                                                <span class="new-price">RP {{ number_format($item->harga - ($item->harga * intval($item->diskon) / 100), 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation Arrows -->
                    <button class="carousel-nav prev" type="button" data-bs-target="#discountCarousel" data-bs-slide="prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-nav next" type="button" data-bs-target="#discountCarousel" data-bs-slide="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize carousel with custom options
    var discountCarousel = new bootstrap.Carousel(document.getElementById('discountCarousel'), {
        interval: 5000,
        wrap: true,
        touch: true
    });
    
    // Add touch swipe functionality
    let touchStartX = 0;
    let touchEndX = 0;
    
    const carousel = document.getElementById('discountCarousel');
    
    carousel.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    carousel.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        if (touchEndX < touchStartX - swipeThreshold) {
            // Swipe left - next slide
            discountCarousel.next();
        }
        if (touchEndX > touchStartX + swipeThreshold) {
            // Swipe right - previous slide
            discountCarousel.prev();
        }
    }
});
</script>