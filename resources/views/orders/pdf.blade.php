<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .container {
            width: 100%;
        }

        .center {
            text-align: center;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 6px;
            text-align: left;
        }

        th {
            border-bottom: 1px solid #ddd;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="center">
        <div class="title">☕ Coffee Shop</div>
        <p>Casablanca - Morocco</p>
        <p>Tel: 06 00 00 00 00</p>
    </div>

    <hr>

    <p><strong>Invoice:</strong> #{{ $order->id }}</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <hr>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->drinks as $drink)
                <tr>
                    <td>{{ $drink->name }}</td>
                    <td>{{ $drink->pivot->quantity }}</td>
                    <td>{{ number_format($drink->price * $drink->pivot->quantity, 2) }} DH</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <p class="total">
        Total: {{ number_format($order->total, 2) }} DH
    </p>

    <hr>

    <p class="center">
        Thank you for your visit 🙏
    </p>

</div>

</body>
</html>
