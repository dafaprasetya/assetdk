<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $asset->dkasset }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/vendor/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('vendor/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">
    
    <div class="container mt-3">
        
        
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="{{ asset('storage/foto_asset/'.$asset->foto) }}" width="100%" alt="" srcset="">
                <h3 style="color: black">{{ $asset->dkasset }}</h3>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <td style="width: 150px">Nama Asset</td>
                                <td>:</td>
                                <td>{{ $asset->nama_asset }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>{{ $asset->kategori->nama }}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>:</td>
                                <td>{{ $asset->user }}</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>{{ $asset->jabatan->nama }}</td>
                            </tr>
                            <tr>
                                <td>Divisi</td>
                                <td>:</td>
                                <td>{{ $asset->divisi->nama }}</td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>{{ $asset->lokasi }}</td>
                            </tr>
                            <tr>
                                <td>Area</td>
                                <td>:</td>
                                <td>{{ $asset->area }}</td>
                            </tr>
                            <tr>
                                <td>Status Aktif</td>
                                <td>:</td>
                                <td>{{ $asset->status_aktif }}</td>
                            </tr>
                            <tr>
                                <td>Kondisi</td>
                                <td>:</td>
                                <td>{{ $asset->kondisi }}</td>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td>:</td>
                                <td>{{ $asset->QTY }}</td>
                            </tr>
                            <tr>
                                <td>Asset Validasi</td>
                                <td>:</td>
                                <td>{{ $asset->asset_validasi }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ $asset->tanggal }}</td>
                            </tr>
                            @if (!empty($asset->signature))
                            <tr>
                                <td>Signature</td>
                                <td>:</td>
                                <td><a href="#" data-toggle="modal" data-target="#SignatureModal">Klik menampilkan signature </a></td>
                            </tr>
                            @endif
                            @if (!empty($asset->foto_tanda_terima))
                            <tr>
                                <td>Foto Tanda Terima</td>
                                <td>:</td>
                                <td><a href="#" data-toggle="modal" data-target="#TandaTerimaModal">Klik menampilkan foto tanda terima </a></td>
                            </tr>
                            @endif
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{ $asset->status }}</td>
                            </tr>
                            <tr>
                                <td>QR</td>
                                <td>:</td>
                                <td><a href="#" data-toggle="modal" data-target="#QRModal">Klik untuk menampilkan QR </a></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                
                @if (!empty($asset->signature))
                <br>
                    {{-- {{ $asset->signature }} --}}
                    {{-- Signature: <a href="#" data-toggle="modal" data-target="#SignatureModal">Klik menampilkan signature </a> --}}
                    {{-- MODALLL SIGNATUREEE --}}
                    <div class="modal fade" id="SignatureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Signature</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/signature_asset/'.$asset->signature) }}" width="400rem" alt="" srcset="">
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <br>
                @if (!empty($asset->foto_tanda_terima))
                    {{-- {{ $asset->signature }} --}}
                    {{-- Tanda Terima: <a href="#" data-toggle="modal" data-target="#TandaTerimaModal">Klik menampilkan foto tanda terima </a> --}}
                    {{-- MODALLL SIGNATUREEE --}}
                    <div class="modal fade" id="TandaTerimaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tanda Terima</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/foto_tanda_terima_asset/'.$asset->foto_tanda_terima) }}" width="400rem" alt="" srcset="">
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <br>
                {{-- Status: {{ $asset->status }} --}}
                <br>
                {{-- QR : <a href="#" data-toggle="modal" data-target="#QRModal">Klik untuk menampilkan QR </a> --}}
                {{-- MODALLL QR --}}
                <div class="modal fade" id="QRModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">QRCODE</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                {!! QrCode::size(200)->generate(route('detailasset',$asset->dkasset)); !!}
                                <p>{{ $asset->dkasset }}</p>
                                <a href="{{ route('cetak') }}?search={{ $asset->dkasset }}">cetak</a>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#HistoryModal">history</button>
            </div>
            {{-- {{ $asset->signature }} --}}
            {{-- MODALLL SIGNATUREEE --}}
            <div class="modal fade" id="HistoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">History Asset</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- {{ $asset->history }} --}}
                            <div class="container">

                                @foreach ($history as $history)
                                    <div class="row">
                                        <div class="col-md-12" style="font-weight: 700">{{ $history->waktu }}</div>
                                        <div class="col-md-12">
                                            <table>
                                                <tr>
                                                    <td style="width: 100px">nama</td>
                                                    <td>:</td>
                                                    <td>{{ $history->pemegang }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Divisi</td>
                                                    <td>:</td>
                                                    <td>{{ $history->divisi_pemegang }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Deskripsi</td>
                                                    <td>:</td>
                                                    <td>{{ $history->deskripsi }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session()->has('gaketemu'))
        <h1>gaketemu bos</h1>
        @endif
        @if (session()->has('error'))
        {{ session()->get('error') }}
        @endif
        @if (session()->has('success'))
        {{ session()->get('success') }}
        @endif
        
        <div class="row">
            <div class="col-md-12 mb-4">
                
                <table>
                    <tr>
                        <td>Tanggal Pembelian : </td>
                         
                        <td>{{ $penyusutan->tanggal_pembelian ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Harga Awal : </td>
                         
                        <td>{{ number_format($penyusutan->harga_awal ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Harga Penyusutan Perhari : </td>
                         
                        <td>{{ number_format($penyusutan->harga_penyusutan_perhari ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Harga total Penyusutan :</td>
                         
                        <td>{{ number_format($penyusutan->harga_penyusutan ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </table>
                <br>
                @if (Auth::user())
                <form action="{{ route('updateharga', $penyusutan->dkasset ?? '') }}" method="post" {{ $penyusutan ?? 'hidden' }}>
                    @csrf
                    <button type="submit" class="'btn btn-sm btn-warning text-dark" href="">update harga</button>
                </form>
                @endif
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
        
        
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('vendor/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('vendor/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('vendor/js/demo/chart-pie-demo.js')}}"></script>

</body>

</html>





