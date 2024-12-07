@extends('admin.core')

@section('content')
{{-- {{ $title }} --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container">
    <h2>Tambah Asset</h2>
    @if (Route::is('editasset'))
    <form method="POST" action="{{ route('editassetpost',$asset->dkasset) }}" enctype="multipart/form-data">
    @csrf
    @endif
    @if (Route::is('tambahasset'))    
    <form method="POST" action="{{ route('tambahassetpost') }}" enctype="multipart/form-data">
    @csrf
    @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="jenis_asset">Jenis Asset (required)</label>
                    {{-- @if (Route::is('tambahasset')) --}}
                    <select name="jenis_asset" id="jenis_asset" class="form-control"{{ Route::is('editasset') ? 'disabled' : '' }}>
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->jenis_asset }}">{{ $asset->jenis_asset }}</option>
                        @endif
                        <option value="DKASSET">DKASSET</option>
                        <option value="DKL">DKL(Asset Lancar)</option>
                    </select>
                    {{-- @endif --}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dkasset">DK Asset (required)</label>
                    @if (Route::is('editasset'))
                    <input type="text" id="angset" name="dkasset" class="form-control" value="{{ $asset->dkasset }}" required>
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" id="angset" name="dkasset" class="form-control" value="{{ old('dkasset') }}" required>
                    @endif
                    @if ($errors->has('dkasset'))
                        <span class="text-danger">{{ $errors->first('dkasset') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="nama_asset">Nama Asset (required)</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="nama_asset" class="form-control" value="{{ $asset->nama_asset }}" required>
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="nama_asset" class="form-control" value="{{ old('nama_asset') }}" required>
                    @endif
                    @if ($errors->has('nama_asset'))
                        <span class="text-danger">{{ $errors->first('nama_asset') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="merk">Merk (required)</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="merk" class="form-control" value="{{ $asset->merk }}">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="merk" class="form-control" value="{{ old('merk') }}">
                    @endif
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori (required)</label>
                    {{-- <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}"> --}}
                    <select name="kategori" id="kategori" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->kategori->id }}">{{ $asset->kategori->nama }}</option>
                        @endif
                        @foreach ($kategori as $kategori)
                            
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="user">User (required)</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="user" class="form-control" value="{{ $asset->user }}">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="user" class="form-control" value="{{ old('user') }}">
                    @endif
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan (required)</label>
                    {{-- <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}"> --}}
                    <select name="jabatan" id="jabatan" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->jabatan->id }}">{{ $asset->jabatan->nama }}</option>
                        @endif
                        @foreach ($jabatan as $jabatan)
                        <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                            
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="divisi">Divisi (required)</label>
                    {{-- <input type="text" name="divisi" class="form-control" value="{{ old('divisi') }}"> --}}
                    <select name="divisi" id="divisi" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->divisi->id }}">{{ $asset->divisi->nama }}</option>
                        @endif
                        @foreach ($divisi as $divisi)
                        <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="area">Area (required)</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="area" class="form-control" value="{{ $asset->area }}">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="area" class="form-control" value="{{ old('area') }}">
                    @endif
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi (required)</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="lokasi" class="form-control" value="{{ $asset->lokasi }}">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}">
                    @endif
                </div>

                <div class="form-group">
                    <label for="status_aktif">Status Aktif (required)</label>
                    {{-- <input type="text" name="status_aktif" class="form-control" value="{{ old('status_aktif') }}"> --}}
                    <select name="status_aktif" id="status_aktif" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->status_aktif }}">{{ $asset->status_aktif }}</option>
                        @endif
                        <option value="Aktif">Aktif</option>
                        <option value="Non Aktif">Non Aktif</option>
                        <option value="Terjual">Terjual</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="kondisi">Kondisi (required)</label>
                    {{-- <input type="text" name="kondisi" class="form-control" value="{{ old('kondisi') }}"> --}}
                    <select name="kondisi" id="kondisi" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->kondisi }}">{{ $asset->kondisi }}</option>
                        @endif
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Hilang">Hilang</option>
                        <option value="Baik Stock Asset">Baik Stock Asset</option>
                        <option value="Rusak Stock Asset">Rusak Stock Asset</option>
                        <option value="Maintenance Stock Asset">Maintenance Stock Asset</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="QTY">QTY (required)</label>
                    @if (Route::is('editasset'))
                    <input type="number" name="QTY" class="form-control" value="{{ $asset->QTY }}">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="number" name="QTY" class="form-control" value="{{ old('QTY') }}">
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="foto">Foto (required, maks. 2mb)</label>
                    @if (Route::is('editasset'))
                    <input type="file" name="foto" class="form-control" value="{{ $asset->foto }}">
                    <br>
                    <img src="{{ asset('storage/foto_asset/'.$asset->foto) }}" width="150px" alt="" srcset="">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="file" name="foto" class="form-control" value="{{ old('foto') }}" required>
                    @endif
                    @if ($errors->has('foto'))
                        <span class="text-danger">{{ $errors->first('foto') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="asset_validasi">Asset Validasi (required)</label>
                    {{-- <input type="text" name="asset_validasi" class="form-control" value="{{ old('asset_validasi') }}" required> --}}
                    <select name="asset_validasi" id="asset_validasi" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->asset_validasi }}">{{ $asset->asset_validasi }}</option>
                        @endif
                        <option value="Validated">Validated</option>
                        <option value="Not Validated">Not Validated</option>
                    </select>
                    @if ($errors->has('asset_validasi'))
                        <span class="text-danger">{{ $errors->first('asset_validasi') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal (required, Format DD/MM/YYYY)</label>
                    @if (Route::is('editasset'))
                    <input type="date" name="tanggal" class="form-control" value="{{ $asset->tanggal }}" required>
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                    @endif
                    @if ($errors->has('tanggal'))
                        <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="signature">Signature (required maks. 2mb)</label>
                    @include('admin.ttd')
                    {{-- <small><a href="#" data-toggle="modal" data-target="#tutorial">klik disini untuk melihat cara membuat tanda tangan online</a></small> --}}
                    
                </div>

                <div class="form-group">
                    <label for="foto_tanda_terima">Foto Tanda Terima</label>
                    @if (Route::is('editasset'))
                    <input type="file" name="foto_tanda_terima" value="{{ $asset->foto_tanda_terima }}" class="form-control">
                    <br>
                    <img src="{{ asset('storage/foto_tanda_terima_asset/'.$asset->foto_tanda_terima) }}" width="150px" alt="" srcset="">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="file" name="foto_tanda_terima" class="form-control">
                    @endif
                </div>

                <div class="form-group">
                    <label for="keterangan_asset">Keterangan Asset (required)</label>
                    @if (Route::is('editasset'))
                    <textarea name="keterangan_asset" class="form-control" required>{{ $asset->keterangan_asset }}</textarea>
                    @endif
                    @if (Route::is('tambahasset'))
                    <textarea name="keterangan_asset" class="form-control" required>{{ old('keterangan_asset') }}</textarea>
                    @endif
                    @if ($errors->has('keterangan_asset'))
                        <span class="text-danger">{{ $errors->first('keterangan_asset') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="status_label_kode">Status Label Kode (required)</label>
                    {{-- <input type="text" name="status_label_kode" class="form-control" value="{{ old('status_label_kode') }}" required> --}}
                    <select name="status_label_kode" id="status_label_kode" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->status_label_kode }}">{{ $asset->status_label_kode }}</option>
                        @endif
                        <option value="SUDAH">Sudah</option>
                        <option value="Selum">Belum</option>
                    </select>
                    @if ($errors->has('status_label_kode'))
                        <span class="text-danger">{{ $errors->first('status_label_kode') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="status">Status (required)</label>
                    <select name="status" id="status" class="form-control">
                        <option value="Baru">Baru</option>
                        <option value="Bekas">Bekas</option>
                    </select
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <div class="form-group">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ Route::is('editasset') ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Pakai Penyusutan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="tanggal_pembelian">Tanggal Pembelian (Required, Format DD/MM/YYYY)</label>
                @if (Route::is('editasset'))
                <input type="date" name="tanggal_pembelian" class="form-control" value="{{ $penyusutan->tanggal_pembelian ?? '' }}" required>
                @endif
                @if (Route::is('tambahasset'))
                <input type="date" name="tanggal_pembelian" class="form-control" value="{{ old('tanggal') }}" required>
                @endif
                @if ($errors->has('tanggal_pembelian'))
                    <span class="text-danger">{{ $errors->first('tanggal_pembelian') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="harga_awal">Harga Awal</label>
                @if (Route::is('editasset'))
                <input type="number" name="harga_awal" class="form-control" value="{{ $penyusutan->harga_awal ?? '' }}">
                @endif
                @if (Route::is('tambahasset'))
                <input type="number" name="harga_awal" class="form-control" value="{{ old('harga_awal') }}">
                @endif
            </div>
            <div class="form-group">
                <label for="harga_awal">Harga Penyusutan PerHari</label>
                @if (Route::is('editasset'))
                <input type="number" name="harga_penyusutan_perhari" class="form-control" value="{{ $penyusutan->harga_penyusutan_perhari ?? '' }}">
                @endif
                @if (Route::is('tambahasset'))
                <input type="number" name="harga_penyusutan_perhari" class="form-control" value="{{ old('harga_penyusutan') }}">
                @endif
            </div>
        </div>
        <script>
            // Mendapatkan elemen checkbox dan form inputs
            const flexSwitchCheckDefault = document.getElementById('flexSwitchCheckDefault');
            const tanggalPembelian = document.querySelector('input[name="tanggal_pembelian"]');
            const hargaAwal = document.querySelector('input[name="harga_awal"]');
            const hargaPenyusutan = document.querySelector('input[name="harga_penyusutan"]');
        
            // Fungsi untuk mengatur disabled berdasarkan status checkbox
            function toggleFormFields() {
                const isChecked = flexSwitchCheckDefault.checked;
        
                // Jika checkbox tidak dicentang, disable form fields
                tanggalPembelian.disabled = !isChecked;
                hargaAwal.disabled = !isChecked;
                hargaPenyusutan.disabled = !isChecked;
            }
        
            // Event listener untuk perubahan status checkbox
            flexSwitchCheckDefault.addEventListener('change', toggleFormFields);
        
            // Jalankan fungsi awal untuk menyesuaikan status form ketika halaman pertama kali dimuat
            toggleFormFields();
        </script>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    // Ambil elemen dropdown dan input
    const kategoriAsset = document.getElementById('jenis_asset');
    const dkAssetInput = document.getElementById('angset');

    // Tambahkan event listener untuk perubahan pada dropdown
    kategoriAsset.addEventListener('change', function () {
        if (kategoriAsset.value === 'DKASSET') {
            dkAssetInput.value = 'DKASSET';
        } else if (kategoriAsset.value === 'DKL') {
            dkAssetInput.value = 'DKL';
        }
    });
</script>
@endsection
