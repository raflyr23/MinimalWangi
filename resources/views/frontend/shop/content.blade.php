<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="h2 pb-4">Categories</h1>
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Gender
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Men</a></li>
                        <li><a class="text-decoration-none" href="#">Women</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                @foreach($product as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="product/{{ $product->image }}">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white mt-2" href="{{ url('product_details', $product->id) }}"><i class="far fa-eye"></i></a></li>
                                        <form action="{{ url('add_cart', $product->id) }}" method="POST">
                                            @csrf
                                            <li>
                                                <button type="submit" class="btn btn-success text-white mt-2">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </li>
                                        </form>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="/detail" class="h3 text-decoration-none">{{ $product->nama_produk }}</a>
                                <p class="text-center mb-0">
                                    @if($product->diskon && $product->diskon != '0%')
                                        <span class="text-muted text-decoration-line-through">RP. {{ number_format($product->harga, 0, ',', '.') }}</span><br>
                                        <span class="text-danger">RP. {{ number_format($product->harga - ($product->harga * intval($product->diskon) / 100), 0, ',', '.') }}</span>
                                    @else
                                        <span>RP. {{ number_format($product->harga, 0, ',', '.') }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div div="row">
                <ul class="pagination pagination-lg justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#" tabindex="-1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" href="#">3</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
