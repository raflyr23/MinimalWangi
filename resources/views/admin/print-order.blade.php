<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #f4f4f9;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header img {
            max-width: 120px;
        }
        .header .company-details {
            text-align: justify;
        }
        .header h1 {
            margin: 0;
            color: #1a613f;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .order-info {
            margin-bottom: 30px;
            font-size: 16px;
        }
        .order-info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #1a613f;
            color: #fff;
        }
        td {
            background-color: #fff;
        }
        .total-row td {
            font-weight: bold;
        }
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }
        footer p {
            margin: 5px 0;
        }
        .order-details {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="company-details">
            <h1>MinimalWangi</h1>
            <p>Jalan-jalan ke tanah abang</p>
            <p>Purwokerto, Indonesia</p>
            <p>Email: minimalwangi@gmail.com</p>
        </div>
    </div>

    <!-- Order Information -->
    <h2>Order ID: {{ $order->id }}</h2>
    <div class="order-info">
        <p><strong>Customer Name:</strong> {{ $order->name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Phone:</strong> {{ $order->no_hp }}</p>
        <p><strong>Address:</strong> {{ $order->alamat }}</p>
        <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
        <p><strong>Delivery Status:</strong> {{ $order->delivery_status }}</p>
    </div>

    <!-- Order Details Table -->
    <h3>Order Details</h3>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

            @php
    $total = 0;  // Initialize total variable
@endphp

@foreach($order->orderDetails as $detail)
<tr>
    <td>{{ $detail->nama_produk }}</td>
    <td>{{ $detail->jumlah }}</td>
    <td>RP. {{ number_format($detail->harga, 0, ',', '.') }}</td>
    <td>RP. {{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}</td>
</tr>
@php
    $total += $detail->harga * $detail->jumlah;  // Sum the total for each item
@endphp
@endforeach

<tr class="total-row">
<td colspan="3" style="text-align: right;">Total:</td>
<td>RP. {{ number_format($total, 0, ',', '.') }}</td>
</tr>
        </tbody>
    </table>

    <!-- Footer -->
    <footer>
        <p>Thank you for your order!</p>
        <p>&copy; {{ date('Y') }} MinimalWangi. All rights reserved.</p>
    </footer>

</body>
</html>
