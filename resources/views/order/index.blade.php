@extends('layouts.main')

@section('title', 'Data Penjaulan')

@section('content')
    <div class="card">
        <div class="card-header">
            Data Penjaulan
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Jumlah Bayar</th>
                        <th>Nama Kasir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Date::parse($item->created_at)->format('j F Y') }}</td>
                            <td>{{ $item->customer_name }}</td>
                            <td>{{ $items->item($item->id) }}</td> 
                            <td>{{ number_format($item->total) }}</td>
                            <td>{{ number_format($item->pay) }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                <a href="{{ route('order.show', $item) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection