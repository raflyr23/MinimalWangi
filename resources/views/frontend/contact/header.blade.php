<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="./assets/img/logo.png" alt="MinimalWangi Logo" class="logo">
        </a>

        <!-- Cart and User icons for mobile -->
        <div class="d-flex d-lg-none">
            <a class="nav-icon position-relative text-decoration-none" href="{{ url('show_cart') }}">
                <i class="fa fa-fw fa-cart-arrow-down text-dark"></i>
                @if($cart_count > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $cart_count }}
                    </span>
                @endif
            </a>
            
            <!-- Toggler -->
            <button class="navbar-toggler border-0 ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="templatemo_main_nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
            </ul>

            <!-- Search form -->
            <form action="{{ url('product_search') }}" method="GET" class="d-flex mb-2 mb-lg-0" id="search-form">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search ...">
                    <button type="submit" class="btn btn-light">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Cart and User icons for desktop -->
            <div class="d-none d-lg-flex align-items-center">
                <a class="nav-icon position-relative text-decoration-none" href="{{ url('show_cart') }}">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark"></i>
                    @if($cart_count > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $cart_count }}
                        </span>
                    @endif
                </a>

                <!-- User Dropdown -->
                <div class="dropdown ms-3">
                    <a class="nav-icon position-relative text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="fa fa-fw fa-user text-dark"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if (Route::has('login'))
                            @auth
                                <li><a class="dropdown-item" href="dashboard">User</a></li>
                                <li><a class="dropdown-item" href="{{ route('order.index') }}">Order</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
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
    </div>
</nav>