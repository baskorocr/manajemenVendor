@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Pemindahan Assets</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Riwayat Pemindahan Asset</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Riwayat Table</h4>
                        <h6 class="card-subtitle">List of all Riwayat</h6>

                        <!-- Input Pencarian -->
                        <div class="mb-3">
                            <input type="text" id="search" class="form-control" placeholder="Search...">
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th>No Assets</th>
                                        <th>ID User</th>
                                        <th>User Name</th>
                                        <th>Status Awal</th>
                                        <th>Status Akhir</th>
                                        <th>Bukti</th>
                                        <th>Tanggal Pemindahan</th>
                                       
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($riwayat as $rwyt)
                                        <tr>
                                            
                                            <td>{{ $rwyt->no_assets }}</td>
                                            <td>{{ $rwyt->idUser }}</td>
                                            <td>{{ $rwyt->user->name ?? 'N/A' }}</td>
                                            <td>{{ $rwyt->StatusAwal }}</td>
                                            <td>{{ $rwyt->StatusAkhir }}</td>
                                            <td>
                                                @if ($rwyt->bukti)
                                                    <img src="{{ asset('storage/' . $rwyt->bukti) }}" alt="Gambar"
                                                        class="img-thumbnail" width="100" height="50">
                                                @else
                                                    <p>No Image</p>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($rwyt->TanggalPemindahan)->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($riwayat->isEmpty())
                                <p class="text-center">No data found.</p>
                            @endif
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
                    url: "{{ route('riwayats.search') }}",
                    type: "GET",
                    data: {
                        'search': query
                    },
                    success: function(data) {
                        console.log(data);
                        console.log(query);
                        $('#table-body').empty();
                        if (data.length > 0) {
                            console.log(data);
                            $.each(data, function(index, item) {
                                var imageHtml = item.bukti ? 
                                `<img src="{{ asset('storage') }}/${item.bukti}" alt="Gambar" class="img-thumbnail" width="100">` :
                                `<p>No Image</p>`;
                                 var dateOnly = item.TanggalPemindahan ? item.TanggalPemindahan.substring(0, 10) : 'N/A';

                                 $('#table-body').append(`
                                    <tr>
                                      
                                        <td>${item.no_assets}</td>
                                        <td>${item.idUser}</td>
                                        <td>${item.user ? item.user.name : 'N/A'}</td>
                                        <td>${item.StatusAwal}</td>
                                        <td>${item.StatusAkhir}</td>
                                         <td>
                                                 ${imageHtml}
                                        </td>
                                        <td>
                                            ${dateOnly}    
                                        </td>
                                       
                                    </tr>
                                `);
                            });
                        } else {
                            $('#table-body').append('<tr><td colspan="7" class="text-center">No data found.</td></tr>');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error occurred: " + textStatus + ", " + errorThrown);
                        $('#table-body').html('<tr><td colspan="7" class="text-center">An error occurred while fetching data. Please try again later.</td></tr>');
                    }
                });
            });
        });
    </script>
@endsection
