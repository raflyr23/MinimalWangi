<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <base href="/public">
    @include('admin.css')
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">

    <style type="text/css">
    .div_center {
        text-align: center;
        padding-top: 40px;
    }

    .font_size {
        font-size: 40px;
        padding-bottom: 40px;
    }

    .text_color {
        color: black;
        padding-bottom: 20px;
    }

    label {
        display: inline-block;
        width: 200px;
    }

    .div_design {
        padding-bottom: 15px;
    }
    </style>
</head>
<body>
    <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel">
        <div class="content-wrapper">
            @if(session()->has('message'))
                
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
            @endif


            <div class="div_center">
            <h1 class="font_size">Tambahkan Produk</h1>
            <form action="{{ url('/update_product_confirm', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="div_design">
                <label>Nama Produk :</label>
                <input class="text_color" type="text" name="title" placeholder="Masukkan Nama" required="" value="{{ $product->nama_produk }}">
                </div>

                <div class="div_design">
                <label>Deskripsi :</label>
                <input class="text_color" type="text" name="description" placeholder="Masukkan Deskripsi" required="" value="{{ $product->deskripsi }}">
                </div>

                <div class="div_design">
                <label>Harga Produk :</label>
                <input class="text_color" type="number" name="harga" placeholder="Masukkan Harga" required="" value="{{ $product->harga }}">
                </div>

                <div class="div_design">
                <label>Jumlah Produk :</label>
                <input class="text_color" type="number" min="0" name="jumlah" placeholder="Masukkan Jumlah" required=""value="{{ $product->jumlah }}">
                </div>

                <div class="div_design">
                <label>Diskon Produk :</label>
                <input class="text_color" type="number" name="diskon" placeholder="Masukkan Diskon" value="{{ $product->diskon }}">
                </div>

                <div class="div_design">
                <label>Kategori Produk :</label>
                <select class="text_color" name="categories" required="" value="{{ $product->categories_name }}">
                    <option value="" selected="">Masukkan Kategori</option>

                    @foreach($categories as $categories)
                    <option value="{{ $categories->categories_name }}">{{ $categories->categories_name }}</option>
                    @endforeach
                    {{-- @foreach($categories as $categories)
                    <option value="{{ $categories->categories_name }}">{{ $categories->categories_name }}</option>
                    @endforeach --}}
                </select>
                </div>

                <div class="div_design">
                    <label>Image Produk :</label>
                    <img style="margin:auto" height="100" width="100" src="/product/{{ $product->image }}" alt="">
                    </div>

                <div class="div_design">
                <label>Ganti Image Produk :</label>
                <input type="file" name="image" required="">
                </div>

                <div class="div_design">
                <input type="submit" value="Update Produk" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.querySelector('.navbar-toggler');
  const body = document.body;

  // Create overlay element
  const overlay = document.createElement('div');
  overlay.className = 'sidebar-overlay';
  body.appendChild(overlay);

  // Toggle sidebar
  toggleBtn.addEventListener('click', function() {
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
    document.querySelector('.page-body-wrapper').classList.toggle('sidebar-open');
  });

  // Close sidebar when clicking overlay
  overlay.addEventListener('click', function() {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
    document.querySelector('.page-body-wrapper').classList.remove('sidebar-open');
  });

  // Close sidebar when window is resized to desktop size
  window.addEventListener('resize', function() {
    if (window.innerWidth > 991) {
      sidebar.classList.remove('active');
      overlay.classList.remove('active');
      document.querySelector('.page-body-wrapper').classList.remove('sidebar-open');
    }
  });
});
  </script>
</html>
