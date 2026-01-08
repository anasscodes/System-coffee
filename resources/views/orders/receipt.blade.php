<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt - Order #{{ $order->id }}</title>

   <style>
body {
    font-family: 'Inter', Arial, sans-serif;
    background: #f3f4f6;
}

.receipt {
    max-width: 360px;
    margin: auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

.title {
    font-size: 22px;
    font-weight: 700;
    letter-spacing: .5px;
}

hr {
    border: none;
    border-top: 1px dashed #e5e7eb;
    margin: 16px 0;
}

.row {
    font-size: 14px;
    margin-bottom: 6px;
}

.total {
    font-size: 18px;
    font-weight: 700;
}

.qr-box {
    margin-top: 15px;
    padding: 12px;
    border: 1px dashed #d1d5db;
    border-radius: 10px;
    background: #fafafa;
}

.footer {
    margin-top: 20px;
    font-size: 12px;
    color: #6b7280;
}

.receipt-actions {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 20px;
}

.btn-secondary {
    padding: 10px 16px;
    background: #e5e7eb;
    color: #111827;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
}
.btn-primary {
    padding: 10px 16px;
    background: #3b82f6;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}

/* ❌ ما يبانوش فـ الطباعة */
@media print {
    .receipt-actions {
        display: none;
    }
}
</style>

</head>

<body>

<div class="receipt">

    {{-- Header --}}
    <div class="center">
        <div class="title">☕ Coffee Shop</div>
        <div class="muted">Casablanca - Morocco</div>
        <div class="muted">Tel: 06 00 00 00 00</div>
    </div>

    <hr>

    {{-- Order Info --}}
    <div class="row">
        <span>Invoice</span>
        <span>#{{ $order->id }}</span>
    </div>

    <div class="row">
        <span>Date</span>
        <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
    </div>

    @if($order->table_number)
        <div class="row">
            <span>Table</span>
            <span>{{ $order->table_number }}</span>
        </div>
    @endif

    <hr>

    {{-- Items --}}
    @foreach($order->drinks as $drink)
        <div class="row">
            <span>
                {{ $drink->name }} x{{ $drink->pivot->quantity }}
            </span>
            <span>
                {{ number_format($drink->price * $drink->pivot->quantity, 2) }} DH
            </span>
        </div>
    @endforeach

    <hr>

    {{-- Total --}}
    <div class="row total">
        <span>Total</span>
        <span>{{ number_format($order->total, 2) }} DH</span>
    </div>

    <hr>

{{-- <div class="center" style="margin-top:15px">
  @if($order->receipt_token)
    {!! QrCode::size(120)->generate(
        route('receipt.show', $order->receipt_token)
    ) !!}
  <p style="font-size:12px">Scan to view receipt</p>
@else
    <p style="font-size:12px; color:#999">
        Ticket will be available after payment
    </p>

    @endif
</div> --}}

<div class="center qr-box">
    {!! QrCode::size(120)->generate(route('receipt.show', $order->receipt_token)) !!}
    <p style="font-size:12px; margin-top:8px">
        📱 Scan to view receipt & rate us
    </p>
</div>




    {{-- Footer --}}
    <div class="footer">
        Thank you for your visit 🙏 <br>
        See you soon!
    </div>

</div>

{{-- Actions --}}
{{-- <div class="center no-print" style="margin-top: 20px;">
    <button onclick="window.print()"
            style="padding:10px 16px; background:#16a34a; color:white; border:none; border-radius:6px; cursor:pointer;">
        🖨 Print Receipt
    </button>

    <br><br>

    <a href="{{ route('orders.show', $order) }}"
       style="font-size:14px; color:#2563eb; text-decoration:none;">
        ⬅ Back to Order
    </a>
</div> --}}

<div class="receipt-actions">
    <a href="{{ route('orders.index') }}" class="btn-secondary">⬅ Back to orders</a>
     <br><br>
    <button onclick="window.print()" class="btn-primary">🖨 Print</button>
</div>






<script>
    window.onload = function () {
        window.print();
    }
</script>


</body>
</html>
