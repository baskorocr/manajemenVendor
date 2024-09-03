<!-- resources/views/assets/index.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Assets</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Assets</li>
                </ol>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <a href="{{ route('assetsPart.create') }}" class="btn btn-info">Add Asset</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assets Table</h4>
                        <h6 class="card-subtitle">List of all assets</h6>

                        <!-- Input Pencarian -->
                        <div class="mb-3">
                            <input type="text" id="search" class="form-control" placeholder="Search...">
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Customer</th>
                                        <th>Project</th>
                                        <th>Vendor</th>
                                        <th>Gambar</th>
                                        <th>Name Part</th>
                                        <th>Number Part</th>
                                        <th>Spek Material</th>
                                        <th>Jenis Asset</th>
                                        <th>Nama Proses</th>
                                        <th>ID Asset</th>
                                        <th>Asset Type</th>
                                        <th>Jumlah (Unit)</th>
                                        <th>Spek Mesin (t)</th>
                                        <th>Pemilik</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($assets as $asset)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $asset->project->customer->name }}</td>
                                            <td>{{ $asset->project->name_project }}</td>
                                            <td>{{ optional($asset->vendor)->name_vendor }}</td>
                                            <td><img src="{{ asset('storage/' . $asset->photo->path) }}" alt="Gambar"
                                                    style="width: 4rem;"></td>
                                            <td>{{ $asset->part->part_name }}</td>
                                            <td>{{ $asset->part->idPart }}</td>
                                            <td>{{ $asset->part->spek_material }}</td>
                                            <td>{{ $asset->assetType->name_type }}</td>
                                            <td>{{ $asset->Proses }}</td>
                                            <td>{{ $asset->no_assets }}</td>
                                            <td>{{ $asset->assetType->name_type }}</td>
                                            <td>{{ $asset->jumlah }}</td>
                                            <td>{{ $asset->machine }}</td>
                                            <td>{{ optional($asset->pemilik)->name_pemilik }}</td>
                                            <td>
                                                <a href="{{ route('assetsPart.edit', $asset->no_assets) }}"
                                                    class="btn btn-warning btn-sm">Pindah Asset</a>
                                                <form action="{{ route('assetsPart.destroy', $asset->no_assets) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                     <button type="submit" class="btn btn-sm btn-danger"
                                                        data-confirm-delete="true">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript/jQuery untuk AJAX Request -->
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('assetsPart.search') }}",
                    type: "GET",
                    data: {
                        'search': query
                    },
                    success: function(data) {
                        $('#table-body').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error occurred: " + textStatus + ", " + errorThrown);
                        $('#table-body').html(
                            '<tr><td colspan="15">An error occurred while fetching data. Please try again later.</td></tr>'
                        );
                    }
                });
            });
        });
    </script>
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
