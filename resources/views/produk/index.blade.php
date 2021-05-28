@extends('layouts.main')

@section('title', 'Produk')

@section('content')

    <a href="{{ route('tambah', $category) }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</a>


    <div class="card">
        <div class="card-header">
            Produk {{ $category->name }}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>Rp. {{ number_format($item->price) }}</td>
                            <td>
                                <a href="{{ route('produk.edit', [$category, $item]) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="d-inline" onsubmit="return confirm('Hapus Produk Ini?')" action="{{ route('produk.hapus', [$category, $item])}}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection