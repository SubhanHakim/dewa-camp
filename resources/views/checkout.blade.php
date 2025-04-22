@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Checkout</h2>
    <p>Order ID: {{ $transaction->order_id }}</p>
    <p>Total: Rp. {{ number_format($transaction->total, 0, ',', '.') }}</p>
    <div id="payment-button"></div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const snapToken = "{{ $snapToken }}";

        snap.pay(snapToken, {
            onSuccess: function(result) {
                alert('Payment success!');
                console.log(result);
                window.location.href = '/'; // Redirect setelah pembayaran berhasil
            },
            onPending: function(result) {
                alert('Waiting for payment!');
                console.log(result);
            },
            onError: function(result) {
                alert('Payment failed!');
                console.log(result);
            },
            onClose: function() {
                alert('You closed the payment popup without finishing the payment.');
            }
        });
    });
</script>
@endsection