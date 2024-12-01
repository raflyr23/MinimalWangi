<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">

    <style type="text/css">
    .div_center
    {
        text-align: center;
        padding-top : 40px;
    }

    .h2_font{
        padding-bottom: 40px;
        font-size: 40px
    }

    .input_color{
        color:black;
    }
    .center{
        margin: auto;
        width: 50%;
        text-align: center;
        margin-top:30px ;
        border: 3px solid white;
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
                    <h2 class="h2_font">Add Categories</h2>
                    <form action="{{ url ('/add_categories') }}" method="POST">

                        @csrf

                        <input class="input_color" type="text" name="categories" placeholder="Masukkan Nama Kategori">
                        <input type="submit" class="btn btn-primary" name="submit">
                    </form>
                </div>

                <table class="center">
                    <tr>
                    <td>Category Name</td>
                    <td>Action</td>

                    </tr>
                    @foreach ($data as $data)
                        
                    <tr>

                    <td>{{ $data->categories_name  }}</td>
                    <td>
                        <a onclick="return confirm('Apakah anda ingin menghapus ini?')" class="btn btn-danger" href="{{ url('delete_categories', $data->id) }}">Delete</a>
                         
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
  </body>
</html>