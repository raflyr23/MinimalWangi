<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

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

        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="title_deg">All Order</h1>

                <div style=" padding-left: 400px; padding-bottom : 30px;">
                    <form action="{{ url ('search') }}" method="get">

                        @csrf

                        <input type="text" name="search" placeholder="search for something">
                        <input type="submit" value="search" class="btn btn-outline-primary">

                    </form>
                </div>

                <table class="table_deg">
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
                            <th>Actions</th>
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
                                <form action="{{ url('/update-order/'.$order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="no_resi" value="{{ $order->no_resi }}" class="form-control">
                                    <select name="delivery_status" class="form-select">
                                        <option value="Diproses" {{ $order->delivery_status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Dikirim" {{ $order->delivery_status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                        <option value="Selesai" {{ $order->delivery_status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Dibatalkan" {{ $order->delivery_status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                                <div class="btn-container">
                                    <button class="btn btn-info btn-sm" onclick="printOrder({{ $order->id }})">Print</button>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="16">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.script')
    

    <script>
        function printOrder(orderId) {
            window.location.href = '/print-order/' + orderId;
        }

        
    </script>
     <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
</body>
</html>