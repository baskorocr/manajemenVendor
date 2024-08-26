<!-- resources/views/assets/edit.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Edit Asset</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Edit Asset</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Asset</h4>
                        <form action="{{ route('assetsPart.update', $asset->id_assets) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="asset_id" value="{{ $asset->id_assets }}">
                            <div class="mb-3">
                                <label for="editVendorSelect" class="form-label">Vendor</label>
                                <select id="editVendorSelect" class="form-select" name="vendor_id" required>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}"
                                            {{ $vendor->id == $asset->vendor_id ? 'selected' : '' }}>
                                            {{ $vendor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editProjectSelect" class="form-label">Project</label>
                                <select id="editProjectSelect" class="form-select" name="project_id" required>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ $project->id == $asset->project_id ? 'selected' : '' }}>
                                            {{ $project->name_project }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editAssetTypeSelect" class="form-label">Asset Type</label>
                                <select id="editAssetTypeSelect" class="form-select" name="asset_type_id" required>
                                    @foreach ($assetTypes as $assetType)
                                        <option value="{{ $assetType->id }}"
                                            {{ $assetType->id == $asset->asset_type_id ? 'selected' : '' }}>
                                            {{ $assetType->name_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editProsesSelect" class="form-label">Proses</label>
                                <select id="editProsesSelect" class="form-select" name="proses_id" required>
                                    @foreach ($proses as $pr)
                                        <option value="{{ $pr->id }}"
                                            {{ $pr->id == $asset->proses_id ? 'selected' : '' }}>
                                            {{ $pr->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editPemilikSelect" class="form-label">Pemilik</label>
                                <select id="editPemilikSelect" class="form-select" name="pemilik_id" required>
                                    @foreach ($pemiliks as $pemilik)
                                        <option value="{{ $pemilik->id }}"
                                            {{ $pemilik->id == $asset->pemilik_id ? 'selected' : '' }}>
                                            {{ $pemilik->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editJumlahInput" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="editJumlahInput" name="jumlah"
                                    value="{{ $asset->jumlah }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Asset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
