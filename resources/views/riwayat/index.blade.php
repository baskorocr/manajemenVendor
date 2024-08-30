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
                                        <th>No Assets</th>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Status Awal</th>
                                        <th>Status Akhir</th>
                                        <th>Gambar</th> <!-- Added for displaying image -->

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
                                                @if ($rwyt->bukti)
                                                    <img src="{{ asset('storage/' . $rwyt->bukti) }}" alt="Gambar"
                                                        class="img-thumbnail" width="100">
                                                @else
                                                    <p>No Image</p>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                @if ($riwayat->isEmpty())
                                    <p class="text-center">No processes available.</p>
                                @endif
                            </table>
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

    <!-- Inline JavaScript for confirmation dialog -->
@endsection
