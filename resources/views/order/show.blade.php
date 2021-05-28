@extends('layouts.main')

@section('title', 'Detail Penjualan')

@section('content')
    <div class="card">
        <div class="card-header">
            Detail Transaksi
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5><strong>{{ $profile->name }}</strong>
                        <small class="float-right">Tanggal {{ Date::parse($order->created_at)->format('j F Y') }}</small>
                    </h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    Invoice #<strong>{{ $order->invoice }}</strong><br>
                    Customer : {{ $order->customer_name }}<br>
                    Kasir : {{ $order->user->name }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Jumlah</th>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->Orderdetail as $item)
                                <tr>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>Rp. {{ number_format($item->product_price) }}</td>
                                    <td>Rp. {{ number_format($item->subtotal) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"><strong>Total</strong></td>
                                    <td><strong>Rp. {{ number_format($order->total) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><strong>Jumlah Bayar</strong></td>
                                    <td><strong>Rp. {{ number_format($order->pay) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><strong>Kembalian</strong></td>
                                    <td><strong>Rp. {{ number_format($order->pay - $order->total) }}</strong></td>
                                </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection