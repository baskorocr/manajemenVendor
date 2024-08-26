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
                <h3 class="text-themecolor">Parts</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Table Parts</li>
                </ol>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <button type="button" class="btn waves-effect waves-light btn-info text-white mb-2" data-bs-toggle="modal"
                    data-bs-target="#addPartModal">Add Part</button>
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
                        <h4 class="card-title">Parts Table</h4>
                        <h6 class="card-subtitle">List of all parts</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Part Name</th>
                                        <th>Material Spec</th>

                                        <th>Machine Spec</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parts as $part)
                                        <tr>
                                            <td>{{ $part->idPart }}</td>
                                            <td>{{ $part->part_name }}</td>
                                            <td>{{ $part->spek_material }}</td>

                                            <td>{{ $part->spek_mesin }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editPartModal{{ $part->idPart }}">
                                                    Edit
                                                </button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('parts.destroy', $part->idPart) }}" method="POST"
                                                    style="display:inline-block;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-confirm-delete="true">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Part Modal -->
                                        <div class="modal fade" id="editPartModal{{ $part->idPart }}" tabindex="-1"
                                            aria-labelledby="editPartModalLabel{{ $part->idPart }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editPartModalLabel{{ $part->idPart }}">
                                                            Edit Part
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('parts.update', $part->idPart) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="partName{{ $part->idPart }}"
                                                                    class="form-label">Part Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="partName{{ $part->idPart }}" name="part_name"
                                                                    value="{{ $part->part_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="spekMaterial{{ $part->idPart }}"
                                                                    class="form-label">Material Spec</label>
                                                                <input type="text" class="form-control"
                                                                    id="spekMaterial{{ $part->idPart }}"
                                                                    name="spek_material" value="{{ $part->spek_material }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jumlah{{ $part->idPart }}"
                                                                    class="form-label">Quantity</label>
                                                                <input type="number" class="form-control"
                                                                    id="jumlah{{ $part->idPart }}" name="jumlah"
                                                                    value="{{ $part->jumlah }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="spekMesin{{ $part->idPart }}"
                                                                    class="form-label">Machine Spec</label>
                                                                <input type="text" class="form-control"
                                                                    id="spekMesin{{ $part->idPart }}" name="spek_mesin"
                                                                    value="{{ $part->spek_mesin }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Update
                                                                    Part</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($parts->isEmpty())
                                <p class="text-center">No parts available.</p>
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

    <!-- Add Part Modal -->
    <div class="modal fade" id="addPartModal" tabindex="-1" aria-labelledby="addPartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPartModalLabel">Add New Part</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('parts.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="idNumber" class="form-label">idNumber</label>
                            <input type="text" class="form-control" id="idPart" name="idPart" required>
                        </div>
                        <div class="mb-3">
                            <label for="partName" class="form-label">Part Name</label>
                            <input type="text" class="form-control" id="partName" name="part_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="spekMaterial" class="form-label">Material Spec</label>
                            <input type="text" class="form-control" id="spekMaterial" name="spek_material" required>
                        </div>

                        <div class="mb-3">
                            <label for="spekMesin" class="form-label">Machine Spec</label>
                            <input type="text" class="form-control" id="spekMesin" name="spek_mesin" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Part</button>
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
