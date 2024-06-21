@extends('layouts.app')

@section('content')
<h1 class="text-center mb-4">Manajemen RT</h1>
    @if (session('success'))
        <div class="d-flex justify-content-center my-3">
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm rounded-pill mb-5" role="alert" style="max-width: 600px; background-color: #d4edda; color: #155724;">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <script>
            setTimeout(function() {
                var alert = document.querySelector('.alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }
            }, 5000);
        </script>
    @endif
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-primary"><i class="bi bi-house-door"></i> Kembali ke Dashboard</a>
        <a href="{{ route('rts.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-dotted"></i> Tambah RT</a>
    </div>
    <div class="card shadow-sm rounded-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">RT</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Ketua RT</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rts as $rt)
                        <tr>
                            <td class="text-center">{{ $rt->nama_rt }}</td>
                            <td class="text-center">{{ $rt->alamat }}</td>
                            <td class="text-center">{{ $rt->ketua_rt }}</td>
                            <td class="text-center">
                                <a href="{{ route('rts.edit', $rt->id) }}" class="btn btn-warning btn-sm me-2"><i class="bi bi-pencil-square"></i> Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $rt->id }}">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteConfirmationModal{{ $rt->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $rt->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content shadow">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $rt->id }}">Konfirmasi Penghapusan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data RT ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('rts.destroy', $rt->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya. Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection