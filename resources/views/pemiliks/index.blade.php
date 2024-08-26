@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Pemilik</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Table Pemilik</li>
                </ol>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <button type="button" class="btn waves-effect waves-light btn-info text-white mb-2" data-bs-toggle="modal"
                    data-bs-target="#addPemilikModal">Tambah Pemilik</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Table Pemilik</h4>
                        <h6 class="card-subtitle">Daftar semua pemilik</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Pemilik</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemiliks as $pemilik)
                                        <tr>
                                            <td>{{ $pemilik->id }}</td>
                                            <td>{{ $pemilik->name_pemilik }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editPemilikModal{{ $pemilik->id }}">
                                                    Edit
                                                </button>

                                                <form action="{{ route('pemiliks.destroy', $pemilik->id) }}" method="POST"
                                                    style="display:inline-block;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-confirm-delete="true">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Pemilik Modal -->
                                        <div class="modal fade" id="editPemilikModal{{ $pemilik->id }}" tabindex="-1"
                                            aria-labelledby="editPemilikModalLabel{{ $pemilik->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editPemilikModalLabel{{ $pemilik->id }}">Edit Pemilik
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('pemiliks.update', $pemilik->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="namePemilik{{ $pemilik->id }}"
                                                                    class="form-label">Nama Pemilik</label>
                                                                <input type="text" class="form-control"
                                                                    id="namePemilik{{ $pemilik->id }}" name="name_pemilik"
                                                                    value="{{ $pemilik->name_pemilik }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-success">Perbarui
                                                                    Pemilik</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($pemiliks->isEmpty())
                                <p class="text-center">Tidak ada pemilik yang tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Pemilik Modal -->
    <div class="modal fade" id="addPemilikModal" tabindex="-1" aria-labelledby="addPemilikModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPemilikModalLabel">Tambah Pemilik Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pemiliks.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="namePemilik" class="form-label">Nama Pemilik</label>
                            <input type="text" class="form-control" id="namePemilik" name="name_pemilik" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Tambah Pemilik</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('button[data-confirm-delete="true"]').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = button.closest('form');

                    Swal.fire({
                        title: 'Anda yakin?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
