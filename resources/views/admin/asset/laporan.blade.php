<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Report bulan {{ $bulan }}</title>
  </head>
  <body>
    <div class="container mb-4 mt-4">
        <div class="row">
            <div class="col-md-12">

                <h3 class="mb-4">Report asset bulan {{ $bulan }}</h3>
                <table id="assetreport" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Status Asset</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
        
                        <tr>
                            <td>Asset kondisi baik</td>
                            <td class="total">{{ $assetbaik->count() }}</td>
                        </tr>
                        <tr>
                            <td>Asset kondisi rusak</td>
                            <td class="total">{{ $assetrusak->count() }}</td>
                        </tr>
                        <tr>
                            <td>Asset kondisi Maintenance</td>
                            <td class="total">{{ $assetmaintenance->count() }}</td>
                        </tr>
                        <tr>
                            <td>Asset Stock kondisi Baik</td>
                            <td class="total">{{ $assetstockbaik->count() }}</td>
                        </tr>
                        <tr>
                            <td>Asset Stock kondisi Rusak</td>
                            <td class="total">{{ $assetstockrusak->count() }}</td>
                        </tr>
                        <tr>
                            <td>Asset Stock kondisi Maintenance</td>
                            <td class="total">{{ $assetstockmaintenance->count() }}</td>
                        </tr>
                        <tr>
                            <td>Asset Hilang</td>
                            <td class="total">{{ $assethilang->count() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">

                <h3>Report serah terima bulan {{ $bulan }}</h3>
                <table class="table" id="serahterimareport">
                    <thead>
                        <tr>
                            <th>Total Serah Terima</th>
                            <th>{{ $serahterima->count() }}</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>DKASSET</th>
                            <th>Penyerah</th>
                            <th>Penerima</th>
                            <th>Waktu</th>
                            <th>SerahTerimaID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($serahterima->get() as $st)
                        <tr>
                            <td>{{ $st->dkasset }}</td>
                            <td>{{ $st->nama_penyerah }}</td>
                            <td>{{ $st->nama_penerima }}</td>
                            <td>{{ $st->waktu }}</td>
                            <td>{{ $st->id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <button class="btn btn-md btn-primary" id="btnExport" onclick="exportReportToExcel()">Download(.xlsx)</button>
        <a class="btn btn-md btn-secondary" href="{{ route('home') }}">Ke Dashboard</a>
    </div>

    <script src="{{ asset('vendor/vendor/xlsx/xlsx.full.min.js') }}"></script>
    <script>
        function exportReportToExcel() {
            // Ambil tabel HTML
            let assetTable = document.getElementById("assetreport");
            let serahterimaTable = document.getElementById("serahterimareport");
    
            // Konversi tabel ke worksheet menggunakan XLSX.utils.table_to_sheet
            let assetSheet = XLSX.utils.table_to_sheet(assetTable);
            let serahterimaSheet = XLSX.utils.table_to_sheet(serahterimaTable);
    
            // Buat workbook baru
            let workbook = XLSX.utils.book_new();
    
            // Tambahkan kedua sheet ke workbook
            XLSX.utils.book_append_sheet(workbook, assetSheet, "Report Asset");
            XLSX.utils.book_append_sheet(workbook, serahterimaSheet, "Report Serah Terima");
    
            // Ekspor file Excel
            XLSX.writeFile(workbook, `Report_bulan_{{ $bulan }}.xlsx`);
        }
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

