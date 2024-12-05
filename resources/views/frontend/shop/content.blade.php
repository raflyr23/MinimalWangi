<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
            
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#categoryList">
                        Kategori
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="list-unstyled pl-3 collapse" id="categoryList">
                        <li>
                            <a href="{{ url('shop?categories_name=men') }}">Pria</a>
                        </li>
                        <li>
                            <a href="{{ url('shop?categories_name=women') }}">Wanita</a>
                        </li>

                        <a href="{{ url('shop?categories_name=unisex') }}">Unisex</a>
                    </li>
                    </ul>
                </li>
            </ul>
        </div>
        
        
        <!-- Main Content -->
        <div class="col-lg-9">
            @if(isset($message))
                <div class="alert alert-warning">
                    {{ $message }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                @foreach($product as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card product-wap rounded-0">
                            <div class="card position-relative">
                                <!-- Discount Badge -->
                                @if($item->diskon && $item->diskon != '0%')
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-danger rounded-pill px-2 py-1" style="font-size: 0.8rem;">-{{ $item->diskon }}</span>
                                    </div>
                                @endif
                                
                                <!-- Product Image -->
                                <img class="card-img rounded-0 img-fluid" src="product/{{ $item->image }}" alt="{{ $item->nama_produk }}" style="object-fit: cover; height: 250px;">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="btn btn-success text-white mt-2" href="{{ url('product_details', $item->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        @if($item->jumlah > 0)
                                            <form action="{{ url('add_cart', $item->id) }}" method="POST">
                                                @csrf
                                                <li>
                                                    <button type="submit" class="btn btn-success text-white mt-2">
                                                        <i class="fas fa-cart-plus"></i>
                                                    </button>
                                                </li>
                                            </form>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{ url('product_details', $item->id) }}" class="h3 text-decoration-none">{{ $item->nama_produk }}</a>
                                
                                <!-- Stock Status -->
                                @if($item->jumlah <= 0)
                                    <div class="text-danger text-center mb-2">Stok Habis</div>
                                @else
                                    <div class="text-success text-center mb-2">Stok: {{ $item->jumlah }}</div>
                                @endif
                                
                                <div class="text-center">
                                    @if($item->diskon && $item->diskon != '0%')
                                        <span class="text-muted text-decoration-line-through small">RP {{ number_format($item->harga, 0, ',', '.') }}</span>
                                        <div class="fw-bold text-danger">
                                            RP {{ number_format($item->harga - ($item->harga * intval($item->diskon) / 100), 0, ',', '.') }}
                                        </div>
                                    @else
                                        <div class="fw-bold">
                                            RP {{ number_format($item->harga, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $product->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>