@extends('layouts.main')

@section('title', 'Edit Profile')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Edit Profile Cafe
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update', $profile) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Nama Cafe</label>
                            <input type="text" class="form-control" name="name" value="{{ $profile->name }}">
                        </div>

                        <div class="form-group">
                            <label>Alamat Cafe</label>
                            <input type="text" class="form-control" name="address" value="{{ $profile->address }}">
                        </div>

                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" class="form-control" name="city" value="{{ $profile->city }}">
                        </div>

                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="number" class="form-control" name="phone" value="{{ $profile->phone }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection