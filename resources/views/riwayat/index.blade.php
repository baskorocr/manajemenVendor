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
                                        <th>User Name</th>
                                        <th>statusAwal</th>
                                        <th>statusAkhir</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat as $rwyt)
                                        <tr>
                                            <td>{{ $rwyt->id }}</td>
                                            <td>{{ $rwyt->no_assets }}</td>
                                            <td>{{ $rwyt->idUser }}</td>
                                            <td>{{ $rwyt->user->name ?? 'N/A' }}</td>
                                            <td>{{ $rwyt->StatusAwal }}</td>
                                            <td>{{ $rwyt->StatusAkhir }}</td>
                                            <td>
                                                <!-- Edit Button -->


                                                <!-- Delete Form -->
                                                <form action="{{ route('riwayat.destroy', $rwyt->id) }}" method="POST"
                                                    style="display:inline-block;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-confirm-delete="true">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Process Modal -->
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
