<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a class="navbar-brand align-self-center" href="{{ url('/') }}">
            <img src="./assets/img/logo.png" alt="MinimalWangi Logo" class="logo">
        </a>
        
        <!-- Toggler untuk navbar di mobile -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Navbar -->
        <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Formulir Pencarian -->
            <form action="{{ url('product_search') }}" method="GET" class="d-flex align-items-center" id="search-form">
                @csrf
                <!-- Tombol Pencarian (Ikon Search) -->
                <button type="button" class="btn btn-light me-1" id="search-icon">
                    <i class="fa fa-fw fa-search"></i>
                </button>

                <!-- Input Pencarian (Disembunyikan pada awalnya) -->
                <input type="text" name="search" class="form-control" id="inputMobileSearch" placeholder="Search ..." style="display: none; width: 200px; border-radius: 20px; transition: width 0.4s ease;">
                
                <!-- Tombol Submit Pencarian (Disembunyikan) -->
                <button type="submit" style="display: none;" id="submit-search"></button>
            </form>

            <!-- Keranjang Belanja -->
            <a class="nav-icon position-relative text-decoration-none ms-1" href="{{ url('show_cart') }}">
                <i class="fa fa-fw fa-cart-arrow-down text-dark"></i>
                @if($cart_count > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $cart_count }}
                    </span>
                @endif
            </a>

            <!-- Dropdown User -->
            <div class="dropdown">
                <a class="nav-icon position-relative text-decoration-none dropdown-toggle ms-3" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-fw fa-user text-dark"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    @if (Route::has('login'))
                        @auth
                            <li><a class="dropdown-item" href="dashboard">User</a></li>
                            <li><a class="dropdown-item" href="{{ route('order.index') }}">Order</a></li>
                            <li>
                                <a href="#" class="dropdown-item" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Script untuk menampilkan input pencarian saat ikon search diklik -->
<script>
    const searchIcon = document.getElementById('search-icon');
    const searchInput = document.getElementById('inputMobileSearch');
    const submitSearch = document.getElementById('submit-search');

    searchIcon.addEventListener('click', function() {
        // Cek apakah input pencarian sedang disembunyikan atau tidak
        if (searchInput.style.display === 'none' || searchInput.style.display === '') {
            // Tampilkan input pencarian dan tombol submit
            searchInput.style.display = 'block';
            searchInput.style.width = '250px'; // Lebar input berubah ketika terlihat
            submitSearch.style.display = 'inline-block';
            searchInput.focus();
        } else {
            // Sembunyikan input pencarian dan tombol submit jika sudah terlihat
            searchInput.style.display = 'none';
            submitSearch.style.display = 'none';
            searchInput.style.width = '200px'; // Mengembalikan lebar input ke semula
        }
    });
</script>
