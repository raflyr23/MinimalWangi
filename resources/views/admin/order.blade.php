<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">

    <style type="text/css">
        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .table_deg {
            border-collapse: collapse;
            width: 90%;
            margin: auto;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table_deg th, 
        .table_deg td {
            border: 1px solid #ddd;
            padding: 12px;
            vertical-align: middle;
        }

        .th_deg {
            background-color: #1a613f;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .img_deg {
            width: 80px;
            height: auto;
            object-fit: contain;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn-container {
            display: flex;
    gap: 15px; /* Jarak antar tombol */
    justify-content: center;
    margin-top: 10px; /* Memberikan jarak atas untuk memperlonggar */
}

        .form-control {
            display: inline;
            width: 100px;
        }

        .form-select {
            display: inline;
            width: 150px;
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
          <div class="content-wrapper">
            <h1 class="text-center text-2xl font-bold mb-6">All Order</h1>
        
            <div class="search-container">
                <form action="{{ url('search') }}" method="get" class="w-full">
                    @csrf
                    <input type="text" name="search" placeholder="Search for something" class="search-input">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </form>
            </div>

    <div class="table-responsive">
        <table class="data-table">
                    <thead>
                        <tr class="th_deg">
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Bukti Pembayaran</th>
                            <th>No Resi</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order as $order)
                        <tr class="tr_deg">
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->no_hp }}</td>
                            <td>{{ $order->alamat }}</td>
                            <td>
                                <img src="/uploads/payments/{{ $order->bukti_pembayaran }}" alt="Payment Proof" class="img_deg">
                            </td>
                            <td>{{ $order->no_resi }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->delivery_status }}</td>
                            <td>
                                <form action="{{ url('/update-order-status/'.$order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                
                                    <!-- Payment Status -->
                                    <label for="payment_status_{{ $order->id }}" class="form-label d-block">Payment Status</label>
                                    <select id="payment_status_{{ $order->id }}" name="payment_status" class="form-select mb-2">
                                        <option value="Pending" {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="Failed" {{ $order->payment_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                
                                    <!-- Delivery Status -->
                                    <label for="delivery_status_{{ $order->id }}" class="form-label d-block">Delivery Status</label>
                                    <select id="delivery_status_{{ $order->id }}" name="delivery_status" class="form-select mb-2">
                                        <option value="Diproses" {{ $order->delivery_status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Dikirim" {{ $order->delivery_status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                        <option value="Selesai" {{ $order->delivery_status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Dibatalkan" {{ $order->delivery_status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                
                                    <!-- No Resi -->
                                    <label for="no_resi_{{ $order->id }}" class="form-label d-block">No Resi</label>
                                    <input type="text" id="no_resi_{{ $order->id }}" name="no_resi" value="{{ $order->no_resi }}" class="form-control mb-2">
                
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>


    @include('admin.script')
     <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>

    
</body>

<script>
    function printOrder(orderId) {
        window.location.href = '/print-order/' + orderId;
    }

    
</script>


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
