@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            Edit Data Kategori
        </div>
        <div class="card-body">
            <form action="{{ route('edit.kategori', $categories->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" class="form-control" value="{{ $categories->name }}" name="name">
            </div>
            <div class="form-group">
                <label>Deskirpsi</label>
                <input type="text" class="form-control" value="{{ $categories->description }}" name="description">
            </div>

            <a href="{{ url('kategori') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
        </div>
    </div>
@endsection