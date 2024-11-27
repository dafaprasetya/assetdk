@extends('core')

@section('content')
{{-- HOMEEEEEE --}}
@if (Route::is('home'))
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Asset</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalasset }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Asset kondisi baik</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{ route('listasset') }}?search=Baik">{{ $totalassetbaik }}</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Asset kondisi rusak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{ route('listasset') }}?search=rusak">{{ $totalassetrusak }}</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Asset dalam perbaikan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{ route('listasset') }}?search=Maintenance">{{ $totalassetperbaikan }}</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Asset Setiap Divisi</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    @foreach ($kategori as $nama_kategori => $kategori_info)
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: {{ $kategori_info['warna'] }}"></i> {{ str_replace('_', ' ', $nama_kategori) }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('vendor/vendor/chart.js/Chart.min.js')}}"></script>


    <script>
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach ($kategori as $nama_kategori => $kategori_info)
                        "{{ str_replace('_', ' ', $nama_kategori) }}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($kategori as $kategori_info)
                            {{ $kategori_info['jumlah'] }},
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach ($kategori as $kategori_info)
                            "{{ $kategori_info['warna'] }}",
                        @endforeach
                    ],
                }],
                
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            // Mendapatkan nama divisi berdasarkan indeks tooltip
                            var label = data.labels[tooltipItem.index];
                            // Mendapatkan jumlah barang langsung dari data
                            var jumlah = data.datasets[0].data[tooltipItem.index];
                            return label + ': ' + jumlah + ' barang';
                        }
                    },
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
@endif

{{-- DKLLLLLLl --}}

@if (Route::is('homedkl'))
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Asset Lancar (DKL)</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Asset Lancar (DKL)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalasset }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Asset Lancar kondisi baik</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{ route('listasset') }}?search=Baik">{{ $totalassetbaik }}</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Asset Lancar kondisi rusak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{ route('listasset') }}?search=rusak">{{ $totalassetrusak }}</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Asset Lancar dalam perbaikan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{ route('listasset') }}?search=Maintenance">{{ $totalassetperbaikan }}</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
