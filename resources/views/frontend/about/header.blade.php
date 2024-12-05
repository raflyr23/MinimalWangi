<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="./assets/img/logo.png" alt="MinimalWangi Logo" class="logo">
        </a>

        <!-- Mobile Icons -->
        <div class="d-flex align-items-center d-lg-none">
            <!-- Cart Icon -->
            <a class="nav-icon position-relative text-decoration-none" href="{{ url('show_cart') }}">
                <i class="fa fa-fw fa-cart-arrow-down text-dark"></i>
                @if($cart_count > 0)
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-danger">
                        {{ $cart_count }}
                    </span>
                @endif
            </a>
            
            <!-- User Dropdown for Mobile -->
            <div class="dropdown mx-2">
                <a class="nav-icon position-relative text-decoration-none" href="#" role="button" id="mobileUserDropdown" data-bs-toggle="dropdown">
                    <i class="fa fa-fw fa-user text-dark"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mobileUserDropdown">
                    @if (Route::has('login'))
                        @auth
                            <li><a class="dropdown-item py-2" href="dashboard">User</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('order.index') }}">Order</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item py-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        @else
                            <li><a class="dropdown-item py-2" href="{{ route('login') }}">Login</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('register') }}">Register</a></li>
                        @endauth
                    @endif
                </ul>
            </div>

            <!-- Toggler -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="templatemo_main_nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-3"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item px-3"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
                <li class="nav-item px-3"><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
                <li class="nav-item px-3"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
            </ul>

            <!-- Search form -->
            <form action="{{ url('product_search') }}" method="GET" class="d-flex mb-3 mb-lg-0 mx-lg-3" id="search-form">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search ...">
                    <button type="submit" class="btn btn-light">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Desktop Icons -->
            <div class="d-none d-lg-flex align-items-center">
                <a class="nav-icon position-relative text-decoration-none" href="{{ url('show_cart') }}">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark"></i>
                    @if($cart_count > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $cart_count }}
                        </span>
                    @endif
                </a>

                <!-- User Dropdown for Desktop -->
                <div class="dropdown ms-3">
                    <a class="nav-icon position-relative text-decoration-none dropdown-toggle" href="#" role="button" id="desktopUserDropdown" data-bs-toggle="dropdown">
                        <i class="fa fa-fw fa-user text-dark"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="desktopUserDropdown">
                        @if (Route::has('login'))
                            @auth
                                <li><a class="dropdown-item" href="dashboard">User</a></li>
                                <li><a class="dropdown-item" href="{{ route('order.index') }}">Order</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>