@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="section">

    <a href="{{ url('kategori/tambah') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</a>

    <div class="card">
        <div class="card-header">
            Kategori
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a href="{{ url('kategori/edit/'.$item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form class="d-inline" onsubmit="return confirm('Yakin Mau Hapus Data Ini?')" action="{{ url('kategori/'.$item->id) }}" method="post">
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
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
        $('button#delete').on('click'), function (){
            var href=$(this).attr('href');
            var tittle=$(this).data('tittle')

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('deleteForm').action = href;
                    document.getElementById('deleteForm').submit();
                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    });
                }
            });
        });
</script>
@endpush