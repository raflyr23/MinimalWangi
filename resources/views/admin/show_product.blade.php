<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">

    <style type="text/css">
    .center{
        margin: auto;
        width: 50%;
        border: 2px solid white;
        text-align: center;
        margin-top: 40px; 
    }

    .font_size{
        text-align: center;
        font-size: 40px;
        padding-top: 20px;
    }

    .image_size{
        width: 100px;
        height: 100px;
    }
    .th_color{
        background: rgb(21, 26, 96);
    }

    .th_deg{
        padding: 30px;
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

                <h2 class="font_size">Semua Produk</h2>

                <table class="center">
                    <tr class="th_color">
                        <th class="th_deg">Nama Produk</th>
                        <th class="th_deg">Deskripsi</th>
                        <th class="th_deg">Diskon</th>
                        <th class="th_deg">Kategori</th>
                        <th class="th_deg">Jumlah</th>
                        <th class="th_deg">Harga</th>
                        <th class="th_deg">Image</th>
                        <th class="th_deg">Delete</th>
                        <th class="th_deg">Edit</th>
                    </tr>

                    @foreach($product as $product)
                    <tr>
                        <td>{{ $product->nama_produk }}</td>
                        <td>{{ $product->deskripsi }}</td>
                        <td>{{ $product->diskon }}</td>
                        <td>{{ $product->categories_name }}</td>
                        <td>{{ $product->jumlah }}</td>
                        <td>{{ $product->harga }}</td>
                        <td>
                            <img class="image_size" src="/product/{{ $product->image }}">
                        </td>
                        <td>
                            <a class="btn btn-danger" onclick=" return confirm('Apakah anda ingin menghapus ini?')" href="{{ url('delete_product', $product->id) }}">Delete</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ url('update_product', $product->id) }}">Edit</a>
                        </td>
                    </tr>

                @endforeach
                </table>
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
</html>