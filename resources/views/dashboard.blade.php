@extends('layouts.main')

@section('title', 'Halaman Kasir')

@section('content')
@include('sweetalert::alert')
@if (Auth::user()->hasRole('kasir'))
    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                Menu Kasir
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div id="custem-search-input">
                            <div class="input-group form-group">
                                <input id="product" name="product" type="text" class="form-control" placeholder="Cari Menu">
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('addProduct') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input type="text" name="menu" id="menu" class="form-control">
                                <input type="hidden" name="id" id="id" class="form-control">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="price" id="price" class="form-control">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="text" name="qty" id="qty" class="form-control">
                            </div>
                        </div>                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                </form>

                <div class="row mt-4">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                Daftar Menu Yang Dipesan
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>Sub Total</th>
                                            <th style="width: 40px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no=0;
                                            $total=0;
                                        @endphp
                                        @foreach ($temp_orders as $order)
                                            @php
                                                $no++;
                                                $subtotal = $order->subtotal;
                                                $total = $total+$subtotal;
                                            @endphp
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $order->product_name }}</td>
                                                <td>{{ number_format($order->product_price) }}</td>
                                                <td>{{ $order->qty }}</td>
                                                <td>{{ number_format($order->subtotal) }}</td>
                                                <td>
                                                    <form action="{{ route('temp_order.destroy', $order->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <th>
                                            <td colspan="3"><b>Total : </b></td>
                                            <td colspan="2"><b>{{ number_format($total) }}</b></td>
                                        </th>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                Detail Transaksi
                            </div>
                            <form action="{{ route('process') }}" method="post">
                                @csrf
                                <input type="hidden" id="total" name="total" value="{{ $total }}" onkeyup="sum();">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Customer</label>
                                                <input type="text" class="form-control @error('customer') is-invalid @enderror" value="{{ old('customer') }}" name="customer">
                                                @if ($errors->has('customer'))
                                                    <span class="invalid-feedback">
                                                        {{ $errors->first('customer') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jumlah Bayar</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="pay" id="pay" onkeyup="sum();">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jumlah Kembalian</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="back" id="back">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Catatan</label>
                                                <textarea name="note" id="note" cols="50" rows="3" class="form-control"></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block">Proses Transaksi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else

@endif

@push('styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script type="text/javascript">
    $('#product').autocomplete({
        source: "{{ route('search') }}",
        minlenght : 1,
        autoFocus : true,
        select:function(e,ui){
            $('#menu').val(ui.item.value);
            $('#price').val(ui.item.price);
            $('#id').val(ui.item.id);
        }

        });
    </script>
    <script>
        function sum() {
                var pay = document.getElementById('pay').value;
                var total = document.getElementById('total').value;
                var result = parseInt(pay) - parseInt(total);
                if (!isNaN(result)) {
                    document.getElementById('back').value = result;
                }
        }
    </script>
@endpush
@endsection