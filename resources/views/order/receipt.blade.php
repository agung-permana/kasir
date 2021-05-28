<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .receipt{
            width: 250px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="card" style="border: none">
            <div class="card-header bg-white" style="border:none">
                <div class="card-tittle">
                    <h5 class="text-center">{{ $profile->name }}</h5>
                    <p class="text-center">{{ $profile->address }}</p>
                    <p class="text-center">{{ $profile->city }}</p>
                </div>
                <hr>
            </div>
        </div>
        <div class="card-body">
            <table width="100%">
                <tr>
                    <td><p>{{ Date::parse($order->created_at)->format('d/m/y') }}</p></td>
                    <td class="text-right"><p>{{ $order->invoice }}</p></td>
                </tr>
            </table>

            <table width="100%">
                @foreach ($order->orderDetail as $item)
                    <tr>
                        <td colspan="2">{{ $item->qty }} x {{ number_format($item->product_price) }}</td>
                    </tr>
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td class="text-right">{{ number_format($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </table>
            <hr>
            <table width="100%">
                <tr>
                    <td>Total</td>
                    <td class="text-right">{{ number_format($order->total) }}</td>
                </tr>
                <tr>
                    <td>Bayar</td>
                    <td class="text-right">{{ number_format($order->pay) }}</td>
                </tr>
                <tr>
                    <td>Kembalian</td>
                    <td class="text-right">{{ number_format($order->pay - $order->total) }}</td>
                </tr>
            </table>
            <hr>
            <table>
                <p class="text-center">Terima Kasih Atas Kunjungan Anda ^_^</p>
                <p class="text-center">Telp. {{ $profile->phone }}</p>
            </table>
        </div>
    </div>
    
</body>
</html>