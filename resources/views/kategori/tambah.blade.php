@extends('layouts.main')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="card">
        <div class="card-header">
            Tambah Kategori
        </div>
        <div class="card-body">
            <form action="{{ url('tambah') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Deskirpsi</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" name="description">
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <a href="{{ url('kategori') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        </div>
    </div>
@endsection