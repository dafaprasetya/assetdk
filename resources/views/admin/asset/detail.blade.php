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
                Nama Asset: {{ $asset->nama_asset }}
                <br>
                Merk: {{ $asset->merk }}
                <br>
                Kategori: {{ $asset->kategori->nama }}
                User: {{ $asset->user }}
                <br>
                Jabatan: {{ $asset->jabatan->nama }}
                <br>
                Divisi: {{ $asset->divisi->nama }}
                <br>
                Lokasi: {{ $asset->lokasi }}
                <br>
                Area: {{ $asset->area }}
                <br>
                Status aktif: {{ $asset->status_aktif }}
                <br>
                Kondisi: {{ $asset->kondisi }}
                <br>
                Quantity: {{ $asset->QTY }}
                <br>
                Asset Validasi: {{ $asset->asset_validasi }}
                <br>
                Tanggal: {{ $asset->tanggal }}
                @if (!empty($asset->signature))
                <br>
                    {{-- {{ $asset->signature }} --}}
                    Signature: <a href="#" data-toggle="modal" data-target="#SignatureModal">Klik menampilkan signature </a>
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
                    Tanda Terima: <a href="#" data-toggle="modal" data-target="#TandaTerimaModal">Klik menampilkan foto tanda terima </a>
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
                Status: {{ $asset->status }}
                <br>
                QR : <a href="#" data-toggle="modal" data-target="#QRModal">Klik untuk menampilkan QR </a>
                {{-- MODALLL QR --}}
                <div class="modal fade" id="QRModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Signature</h5>
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





