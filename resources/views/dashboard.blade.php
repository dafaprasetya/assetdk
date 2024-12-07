@extends('core')

@section('content')
{{-- HOMEEEEEE --}}
@if (Route::is('home'))
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <form
                class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('buatlaporan') }}">
                <div class="input-group">
                    <input type="date" class="form-control bg-light border-0 small" placeholder="report" aria-label="report" aria-describedby="basic-addon2" id="datee" name="">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="report" aria-label="report" aria-describedby="basic-addon2" id="report" name="report" hidden>
                    <button type="submit" id="generate-report"  class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i>
                        Buat Report</button>
                </div>
                <script>
                    document.getElementById('generate-report').addEventListener('click', function (e) {
                        const dateInput = document.getElementById('datee').value;
                
                        // Cek apakah pengguna telah memilih tanggal
                        if (dateInput) {
                            // Ekstraksi tahun dan bulan dari input
                            const [year, month] = dateInput.split('-');
                            document.getElementById('report').value = `${year}-${month}`
                        } else {
                            e.preventDefault()
                            alert('Masukan Bulan Terlebih Dahulu');
                        }
                    });
                </script>
            </form>
        </div>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
                              </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-layout-wtf" viewBox="0 0 16 16">
                                <path d="M5 1v8H1V1zM1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm13 2v5H9V2zM9 1a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM5 13v2H3v-2zm-2-1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1zm12-1v2H9v-2zm-6-1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1z"/>
                              </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                                <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3q0-.405-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
                              </svg>
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
                <h6 class="m-0 font-weight-bold text-primary">Asset Setiap Kategori</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    @foreach ($kategori as $nama_kategori => $kategori_info)
                    <span class="mr-2">
                        <i class="fas fa-circle" style="color: {{ $kategori_info['warna'] }}"></i> {{ str_replace('_', ' ', $nama_kategori) }} :{{ $kategori_info['jumlah'] }} Barang
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
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <form
                class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('buatlaporandkl') }}">
                <div class="input-group">
                    <input type="date" class="form-control bg-light text-dark border-0 small" placeholder="report" aria-label="report" aria-describedby="basic-addon2" id="datee" name="">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="report" aria-label="report" aria-describedby="basic-addon2" id="report" name="report" hidden>
                    <button type="submit" id="generate-report"  class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i>
                        Buat Report</button>
                </div>
                <script>
                    document.getElementById('generate-report').addEventListener('click', function (e) {
                        const dateInput = document.getElementById('datee').value;
                
                        // Cek apakah pengguna telah memilih tanggal
                        if (dateInput) {
                            // Ekstraksi tahun dan bulan dari input
                            const [year, month] = dateInput.split('-');
                            document.getElementById('report').value = `${year}-${month}`
                        } else {
                            e.preventDefault()
                            alert('Masukan Bulan Terlebih Dahulu');
                        }
                    });
                </script>
            </form>
        </div>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
                              </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-layout-wtf" viewBox="0 0 16 16">
                                <path d="M5 1v8H1V1zM1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm13 2v5H9V2zM9 1a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM5 13v2H3v-2zm-2-1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1zm12-1v2H9v-2zm-6-1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1z"/>
                              </svg>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                            <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3q0-.405-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
                          </svg>
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
                <h6 class="m-0 font-weight-bold text-primary">Asset Lancar Setiap Kategori</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    @foreach ($kategori as $nama_kategori => $kategori_info)
                    <span class="mr-2">
                        <i class="fas fa-circle" style="color: {{ $kategori_info['warna'] }}"></i> {{ str_replace('_', ' ', $nama_kategori) }} :{{ $kategori_info['jumlah'] }} Barang
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
@endsection
