@extends('layouts.main')

@section('title', 'Pengaturan')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>Profil Cafe</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Cafe</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $profile->name }}</td>
                                <td>{{ $profile->address }}</td>
                                <td>{{ $profile->city }}</td>
                                <td>{{ $profile->phone }}</td>
                                <td>
                                    <a href="{{ route('profile.edit', $profile) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection