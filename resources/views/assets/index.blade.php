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


                                        <th>Spek Mesin (Ton)</th>
                                        <th>Pemilik</th>


                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assets as $asset)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $asset->project->customer->name }}</td>
                                            <td>{{ $asset->project->name_project }}</td>
                                            <td>{{ optional($asset->vendor)->name_vendor }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $asset->photo->path) }}" alt="Gambar"
                                                    style="width: 4rem;">
                                            </td>
                                            <td>{{ $asset->part->part_name }}</td>
                                            <td>{{ $asset->part->idPart }}</td>
                                            <td>{{ $asset->part->spek_material }}</td> <!-- Display namePart -->
                                            <td>{{ $asset->assetType->name_type }}</td>
                                            <td>{{ $asset->proses->proses_name }}</td>



                                            <td>{{ $asset->no_assets }}</td>




                                            <td>{{ $asset->assetType->name_type }}</td>


                                            <td>{{ $asset->jumlah }}</td>
                                            <!-- Display namePart -->

                                            <td>{{ $asset->part->spek_mesin }}</td> <!-- Display namePart -->
                                            <td>{{ optional($asset->pemilik)->name_pemilik }}</td>
                                            <!-- Display gambar -->
                                            <td>
                                                <a href="{{ route('assetsPart.edit', $asset->no_assets) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('assetsPart.destroy', $asset->no_assets) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
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
@endsection
