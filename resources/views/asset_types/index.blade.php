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
                <h3 class="text-themecolor">Asset Types</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Table Asset Types</li>
                </ol>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <button type="button" class="btn waves-effect waves-light btn-info text-white mb-2" data-bs-toggle="modal" data-bs-target="#addAssetTypeModal">Add Asset Type</button>
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
                        <h4 class="card-title">Asset Type Table</h4>
                        <h6 class="card-subtitle">List of all asset types</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name Asset Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assetTypes as $assetType)
                                        <tr>
                                            <td>{{ $assetType->id }}</td>
                                            <td>{{ $assetType->name_type }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAssetTypeModal{{ $assetType->id }}">Edit</button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('asset-types.destroy', $assetType->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Asset Type Modal -->
                                        <div class="modal fade" id="editAssetTypeModal{{ $assetType->id }}" tabindex="-1" aria-labelledby="editAssetTypeModalLabel{{ $assetType->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editAssetTypeModalLabel{{ $assetType->id }}">Edit Asset Type</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('asset-types.update', $assetType->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="assetTypeName{{ $assetType->id }}" class="form-label">Name Asset Type</label>
                                                                <input type="text" class="form-control" id="assetTypeName{{ $assetType->id }}" name="name_type" value="{{ $assetType->name_type }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Update Asset Type</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($assetTypes->isEmpty())
                                <p class="text-center">No asset types available.</p>
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

    <!-- Add Asset Type Modal -->
    <div class="modal fade" id="addAssetTypeModal" tabindex="-1" aria-labelledby="addAssetTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAssetTypeModalLabel">Add New Asset Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('asset-types.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="assetTypeName" class="form-label">Name Asset Type</label>
                            <input type="text" class="form-control" id="assetTypeName" name="name_type" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Asset Type</button>
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
