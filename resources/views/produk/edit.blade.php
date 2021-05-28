@extends('layouts.main')

@section('title', 'Edit Produk')
    
@section('content')
    <div class="card">
        <div class="card-header">
            Edit {{ $category->name }}
        </div>
        <div class="card-body">
            <form action="{{ route('produk.update', [$category, $product]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" value="{{ $product->name }}" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" value="{{ $product->price }}" class="form-control" name="price">
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection