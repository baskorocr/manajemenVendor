@extends('layouts.admin')

@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Pemindahan Assets</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Riwayat Pemindahan Asset</li>
                </ol>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Riwayat Table</h4>
                        <h6 class="card-subtitle">List of all Riwayat</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>no_aseets</th>
                                        <th>idUser</th>
                                        <th>statusAwal</th>
                                        <th>statusAkhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat as $rwyt)
                                        <tr>
                                            <td>{{ $rwyt->id }}</td>
                                            <td>{{ $rwyt->not_assets }}</td>
                                            <td>{{ $rwyt->idUser }}</td>
                                            <td>{{ $rwyt->StatusAwal }}</td>
                                            <td>{{ $rwyt->StatusAkhir }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editProsesModal{{ $rwyt->id }}">
                                                    Edit
                                                </button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('proses.destroy', $rwyt->id) }}" method="POST"
                                                    style="display:inline-block;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-confirm-delete="true">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Process Modal -->
                                        <div class="modal fade" id="editProsesModal{{ $rwyt->id }}" tabindex="-1"
                                            aria-labelledby="editProsesModalLabel{{ $rwyt->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editProsesModalLabel{{ $rwyt->id }}">Edit Process
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('proses.update', $rwyt->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="prosesName{{ $rwyt->id }}"
                                                                    class="form-label">Name Process</label>
                                                                <input type="text" class="form-control"
                                                                    id="prosesName{{ $rwyt->id }}" name="proses_name"
                                                                    value="{{ $rwyt->proses_name }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Update
                                                                    Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($riwayat->isEmpty())
                                <p class="text-center">No processes available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    <!-- Add Process Modal -->
    <div class="modal fade" id="addProsesModal" tabindex="-1" aria-labelledby="addProsesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProsesModalLabel">Add New Process</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('proses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="prosesName" class="form-label">Name Process</label>
                            <input type="text" class="form-control" id="proses_name" name="proses_name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Process</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline JavaScript for confirmation dialog -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('button[data-confirm-delete="true"]').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = button.closest('form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
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
