<!DOCTYPE html>
<html>
<head>
    <title>Receipt #{{ $order->id }}</title>
    <style>
        body {
            font-family: monospace;
            width: 300px;
            margin: auto;
        }
        h2, p {
            text-align: center;
        }
        table {
            width: 100%;
            margin-top: 10px;
        }
        td {
            padding: 4px 0;
        }
        .total {
            border-top: 1px dashed #000;
            margin-top: 10px;
            padding-top: 5px;
            font-weight: bold;
        }
        @media print {
            button { display: none; }
        }
    </style>
</head>

<body>

<h2>☕ Cafe System</h2>
<p>Order #{{ $order->id }}</p>

<p>
Table: {{ $order->table_number ?? '-' }} <br>
Status: {{ strtoupper($order->status) }} <br>
{{ $order->created_at->format('d/m/Y H:i') }}
</p>

<table>
@foreach($order->drinks as $drink)
<tr>
    <td>{{ $drink->name }} x{{ $drink->pivot->quantity }}</td>
    <td align="right">
        {{ $drink->price * $drink->pivot->quantity }} DH
    </td>
</tr>
@endforeach
</table>

<div class="total">
TOTAL: {{ $order->total }} DH
</div>

<br>

<button onclick="window.print()">🖨 Print</button>

</body>
</html>
