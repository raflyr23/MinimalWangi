<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Midtrans Payment</title>
</head>
<body>
    <h2>Checkout Payment</h2>

    <p>Order ID: {{ $order->id }}</p>
    <p>Total Price: RP. {{ number_format($order->total_amount, 0, ',', '.') }}</p>

    <!-- Tombol untuk memulai pembayaran menggunakan Midtrans Snap -->
    <button id="pay-button">Pay with Midtrans</button>

    <!-- Script Midtrans Snap -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Payment Success: " + JSON.stringify(result));
                    // Optionally, redirect to a success page or update order status
                },
                onPending: function(result) {
                    alert("Payment Pending: " + JSON.stringify(result));
                },
                onError: function(result) {
                    alert("Payment Error: " + JSON.stringify(result));
                }
            });
        };
    </script>
</body>
</html>
