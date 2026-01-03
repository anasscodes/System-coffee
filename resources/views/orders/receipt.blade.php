<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt - Order #{{ $order->id }}</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 20px;
        }

        .receipt {
            max-width: 360px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
        }

        .center {
            text-align: center;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .muted {
            color: #6b7280;
            font-size: 12px;
        }

        hr {
            border: none;
            border-top: 1px dashed #d1d5db;
            margin: 15px 0;
        }

        .row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .bold {
            font-weight: bold;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .receipt {
                box-shadow: none;
                border-radius: 0;
            }

            .no-print {
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

  <div class="center" style="margin-top:15px">
        {!! QrCode::encoding('UTF-8')->size(120)->generate(
            route('orders.show', $order)
        ) !!}
        <p style="font-size:12px">Scan to view order</p>
    </div>

    {{-- Footer --}}
    <div class="footer">
        Thank you for your visit 🙏 <br>
        See you soon!
    </div>

</div>

{{-- Actions --}}
<div class="center no-print" style="margin-top: 20px;">
    <button onclick="window.print()"
            style="padding:10px 16px; background:#16a34a; color:white; border:none; border-radius:6px; cursor:pointer;">
        🖨 Print Receipt
    </button>

    <br><br>

    <a href="{{ route('orders.show', $order) }}"
       style="font-size:14px; color:#2563eb; text-decoration:none;">
        ⬅ Back to Order
    </a>
</div>





<script>
    window.onload = function () {
        window.print();
    }
</script>


</body>
</html>
