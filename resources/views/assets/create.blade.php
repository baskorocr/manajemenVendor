<!-- resources/views/assets/create.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Add New Asset</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Add Asset</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Asset</h4>
                        <form action="{{ route('assetsPart.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="noAssetsInput" class="form-label">No Assets</label>
                                <input type="number" class="form-control" id="noAssetsInput" name="no_assets" required>
                                @if ($errors->has('no_assets'))
                                    <span class="text-danger">Jumlah Digit No Assets Melebihi yang ditentukan</span>
                                @endif

                            </div>



                            <div class="mb-3">
                                <label for="vendorSelect" class="form-label">Vendor</label>
                                <select id="vendorSelect" class="form-select" name="vendor_id" required>
                                    <option value="">Select a vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name_vendor }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="projectSelect" class="form-label">Project</label>
                                <select id="projectSelect" class="form-select" name="project_id" required>
                                    <option value="">Select a project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name_project }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="assetTypeSelect" class="form-label">Asset Type</label>
                                <select id="assetTypeSelect" class="form-select" name="asset_type_id" required>
                                    <option value="">Select an asset type</option>
                                    @foreach ($assetTypes as $assetType)
                                        <option value="{{ $assetType->id }}">{{ $assetType->name_type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="pemiliksSelect" class="form-label">Pemilik</label>
                                <select id="pemiliksSelect" class="form-select" name="pemiliks_id" required>
                                    <option value="">Select a pemilik</option>
                                    @foreach ($pemiliks as $pemilik)
                                        <option value="{{ $pemilik->id }}">{{ $pemilik->name_pemilik }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="photoSelect" class="form-label">Photo</label>
                                <select id="photoSelect" class="form-select" name="photo_id" required>
                                    <option value="">Select a photo</option>
                                    @foreach ($photos as $photo)
                                        <option value="{{ $photo->id }}">{{ $photo->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="partSelect" class="form-label">Part</label>
                                <select id="partSelect" class="form-select" name="idPart" required>
                                    <option value="">Select a part</option>
                                    @foreach ($parts as $part)
                                        <option value="{{ $part->idPart }}">{{ $part->part_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jumlahInput" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlahInput" name="jumlah" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Asset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
