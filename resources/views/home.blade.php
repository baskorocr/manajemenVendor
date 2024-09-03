@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Dashboard</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">All Data</li>
                </ol>
            </div>
        </div>
        <div class="row d-flex mb-3 bg-white">
            <!-- Column for Greeting and Time -->
            <div class="col-lg-7 d-flex align-items-stretch mb-3 bg-white">
                <div class="d-flex flex-column align-items-center justify-content-center w-100 p-3 ">
                    <h2>Hello, {{ auth()->user()->name }} 🙌. Work spirit!</h2>
                    <h4 id="greeting" class="mt-3">Loading greeting...</h4>
                    <h1 id="current-time" class="mt-4">Loading time...</h1>
                </div>
            </div>
            <!-- Column for Weather Information -->
            <div class="col-lg-5 d-flex align-items-stretch mb-3">
                <div class="d-flex flex-column align-items-center justify-content-center w-100 p-3 bg-white">
                    <h2>Weather Information for Cikarang</h2>
                    <div id="weather-description" class="text-center">
                        <img id="weather-icon" src="" alt="Weather icon"
                            style="width:50px;height:50px;display:none;">
                        <p id="weather-text">Loading...</p>
                        <p id="temperature">Loading temperature...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row d-flex">
            <!-- Total Assets Card -->
            <div class="col-lg-4 d-flex align-items-stretch mb-3">
                <div class="card flex-fill d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                        <h2>Total Assets</h2>
                        <h4>{{ $totalAssets }}</h4>
                    </div>
                </div>
            </div>

            <!-- Total Vendors Card -->
            <div class="col-lg-4 d-flex align-items-stretch mb-3">
                <div class="card flex-fill d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                        <h2>Total Vendors Active</h2>
                        <h4>{{ $totalVendors }}</h4>
                    </div>
                </div>
            </div>

            <!-- Total Projects Card -->
            <div class="col-lg-4 d-flex align-items-stretch mb-3">
                <div class="card flex-fill d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                        <h2>Total Projects Active</h2>
                        <h4>{{ $totalProjects }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assets Table -->
        <div class="row d-flex">
            <div class="col-lg-12 d-flex align-items-stretch mb-3">
                <div class="card flex-fill">
                    <div class="card-body">
                        <h4 class="card-title">Assets Data</h4>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($assets as $asset)
                                        <tr>
                                            <td>{{ $asset->no_assets }}</td>
                                            <td>{{ $asset->customer_name ?? 'N/A' }}</td>
                                            <td>{{ $asset->project_name }}</td>
                                            <td>{{ $asset->vendor_name }}</td>
                                            <td>
                                                <img src="storage/{{ $asset->photo_url }}" alt="Asset Image"
                                                    style="width: 100px; height: auto;">
                                            </td>
                                            <td>{{ $asset->part_name }}</td>
                                            <td>{{ $asset->idPart }}</td>
                                            <td>{{ $asset->spek_material }}</td>
                                            <td>{{ $asset->asset_type_name }}</td>
                                            <td>{{ $asset->proses }}</td>
                                            <td>{{ $asset->no_assets }}</td>
                                            <td>{{ $asset->asset_type_name }}</td>
                                            <td>{{ $asset->jumlah }}</td>
                                            <td>{{ $asset->machine }}</td>
                                            <td>{{ $asset->owner_name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="15">No assets found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="pagination-wrapper">
                            {{ $assets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Ensure jQuery and other necessary scripts are loaded -->
    <script>
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('current-time').innerText = timeString;

            let greeting;
            if (hours >= 5 && hours < 12) {
                greeting = 'Good Morning';
            } else if (hours >= 12 && hours < 17) {
                greeting = 'Good Afternoon';
            } else if (hours >= 17 && hours < 21) {
                greeting = 'Good Evening';
            } else {
                greeting = 'Good Night';
            }
            document.getElementById('greeting').innerText = greeting;
        }

        function fetchWeather() {
            fetch('https://wttr.in/Cikarang?format=%C+%t')
                .then(response => response.text())
                .then(data => {
                    const [description, temperature] = data.split(' ');
                    document.getElementById('weather-text').innerText = description;
                    console.log(data);
                    document.getElementById('temperature').innerText = `Temperature: ${temperature}`;

                    const weatherIcon = document.getElementById('weather-icon');
                    const descriptionLower = description.toLowerCase();

                    if (descriptionLower.includes('clear')) {
                        weatherIcon.src = 'https://openweathermap.org/img/wn/01d.png';
                    } else if (descriptionLower.includes('partly cloudy') || descriptionLower.includes('cloudy')) {
                        weatherIcon.src = 'https://openweathermap.org/img/wn/02d.png';
                    } else if (descriptionLower.includes('rain')) {
                        weatherIcon.src = 'https://openweathermap.org/img/wn/09d.png';
                    } else if (descriptionLower.includes('snow')) {
                        weatherIcon.src = 'https://openweathermap.org/img/wn/13d.png';
                    } else if (descriptionLower.includes('fog')) {
                        weatherIcon.src = 'https://openweathermap.org/img/wn/50d.png';
                    } else {
                        weatherIcon.src =
                            'https://openweathermap.org/img/wn/04d.png'; // Default icon for unknown weather
                    }
                    weatherIcon.style.display = 'inline';
                })
                .catch(error => {
                    document.getElementById('weather-text').innerText = 'Weather information is unavailable.';
                    console.error('Error fetching weather data:', error);
                });
        }

        setInterval(updateTime, 1000);
        updateTime();
        fetchWeather();
    </script>
@endsection
