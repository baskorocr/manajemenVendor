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
                        <form action="{{ route('assetsPart.update', $asset->no_assets) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="no_asset" value="{{ $asset->no_assets }}">

                            <div class="mb-3">
                                <label for="editVendorSelect" class="form-label">Vendor</label>
                                <select id="editVendorSelect" class="form-select" name="vendor_id" required>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}"
                                            {{ $vendor->id == $asset->vendor_id ? 'selected' : '' }}>
                                            {{ $vendor->name_vendor }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" readonly name="tempVendorAwal"
                                value="{{ $vendors->firstWhere('id', $asset->vendor_id)->name_vendor ?? '' }}">
                            <input type="hidden" id="tempVendorAkhir" class="form-control" readonly name="tempVendorAkhir">




                            <div class="mb-3">
                                <label for="editPemilikSelect" class="form-label">Pemilik</label>
                                <select id="editPemilikSelect" class="form-select" name="pemilik_id" required>
                                    @foreach ($pemiliks as $pemilik)
                                        <option value="{{ $pemilik->id }}"
                                            {{ $pemilik->id == $asset->pemiliks_id ? 'selected' : '' }}>
                                            {{ $pemilik->name_pemilik }}
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const vendorSelect = document.getElementById('editVendorSelect');
            const tempVendorInput = document.getElementById('tempVendorAkhir');
            const originalVendorId = vendorSelect.querySelector('option[selected]').value;

            vendorSelect.addEventListener('change', function() {
                const selectedVendorId = this.value;
                const selectedVendorName = this.options[this.selectedIndex].text;

                if (selectedVendorId === originalVendorId) {
                    tempVendorInput.value = '';
                } else {
                    tempVendorInput.value = selectedVendorName;
                }
            });
        });
    </script>
@endsection
