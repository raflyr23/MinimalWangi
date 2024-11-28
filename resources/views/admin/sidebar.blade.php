<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="/redirect">Atmin</a>
      <a class="sidebar-brand brand-logo-mini" href="/redirect">Atmin</a>
    </div>
    <ul class="nav">
      
      
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('/redirect') }}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Produk</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('/view_product') }}">Tambahkan Produk</a></li>
            <li class="nav-item"> 
                <a class="nav-link" href="{{ '/show_product' }}">Tampilkan Produk</a></li>
            
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('view_categories') }}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Categories</span>
        </a>
      </li>


      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('order') }}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Order</span>
        </a>
      </li>
    </ul>
  </nav>