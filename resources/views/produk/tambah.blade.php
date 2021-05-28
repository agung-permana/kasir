@extends('layouts.main')

@section('title', 'Tambah Produk')

@section('content')
    <div class="card">
        <div class="card-header">
            Tambah Produk {{ $category->name }}
        </div>
        <div class="card-body">
            <form action="{{ route('tambahProses', $category) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" name="price">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <a href="{{ url('kategori') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        </div>
    </div>
@endsection