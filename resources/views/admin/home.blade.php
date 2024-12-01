<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">

    <style class="text/css">
    
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
       @include('admin.content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
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