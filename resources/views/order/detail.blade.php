@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <div class="float-right">
                <input type="button" class="btn btn-primary" id="print" onclick="printreceipt()" value="Cetak Nota">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Detail Transaksi
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="bg-light">No. Invoice</td>
                                <td class="bg-light"><strong>{{ $lastOrder->invoice }}</strong></td>
                            </tr>

                            <tr>
                                <td>Tanggal</td>
                                <td>{{ Date::parse($lastOrder->created_at)->format('j F Y') }}</td>
                            </tr>

                            <tr>
                                <td>Nama Customer</td>
                                <td>{{ $lastOrder->customer_name }}</td>
                            </tr>

                            <tr>
                                <td>Total</td>
                                <td>Rp. {{ number_format($lastOrder->total) }}</td>
                            </tr>

                            <tr>
                                <td>Jumlah DIbayar</td>
                                <td>Rp. {{ number_format($lastOrder->pay) }}</td>
                            </tr>

                            <tr>
                                <td>Jumlah Kembalian</td>
                                <td>Rp. {{ number_format($lastOrder->pay - $lastOrder->total) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-7">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Menu Yang Dipesan
                </div>
                <div class="card-body">
                    <table class="table table-bordered condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Jumlah Pesanan</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastOrder->orderDetail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ number_format($item->product_price) }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ number_format($item->subtotal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th>{{ number_format($lastOrder->total) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function printreceipt() {
            var URL = "{{ route('receipt', $lastOrder) }}";
            var W = window.open(URL);
            W.window.print();
        }
    </script>
@endpush