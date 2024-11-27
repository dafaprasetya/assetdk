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
    <h2>Serah Terima</h2>
    <small style="color: red">*pastikan tidak ada yang salah karna data ini bersifat tidak bisa diedit</small>
    @if (Route::is('editserahterima'))
    <form method="POST" action="{{ route('editpostserahterima', $serahterima->id) }}" enctype="multipart/form-data">
    @else
    <form method="POST" action="{{ route('createserahterima') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="form-group">
        <label for="jenis_asset">Jenis Asset</label>
        {{-- @if (Route::is('tambahasset')) --}}
        <select name="jenis_asset" id="jenis_asset" class="form-control"{{ Route::is('editserahterima') ? 'disabled' : '' }}>
            @if (Route::is('editserahterima'))
            <option value="{{ $serahterima->jenis_asset }}">{{ $serahterima->jenis_asset }}</option>
            @endif
            <option value="DKASSET">DKASSET</option>
            <option value="DKL">DKL(Asset Lancar)</option>
        </select>
        {{-- @endif --}}
    </div>
    <div class="form-group">
        <label for="dkasset">DK Asset</label>
        
        <select name="dkasset" id="dkasset" class="form-control" required>
            @if (Route::is('editserahterima'))
            <option value="{{ $serahterima->dkasset }}">{{ $serahterima->dkasset }}</option>
            @endif
            @foreach ($asset as $asset)
            <option value="{{ $asset->dkasset }}">{{ $asset->dkasset }}</option>
            @endforeach
            @foreach ($assetdkl as $asset)
            <option value="{{ $asset->dkasset }}">{{ $asset->dkasset }}</option>
            @endforeach
        </select>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_asset">Nama Penerima</label>
                    @if (Route::is('editserahterima'))
                        <input type="text" name="nama_penerima" class="form-control" value="{{ $serahterima->nama_penerima }}" required>
                    @else
                    <input type="text" name="nama_penerima" class="form-control" value="" required>
                    @endif
                    
                    @if ($errors->has('nama_asset'))
                        <span class="text-danger">{{ $errors->first('nama_asset') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan penerima</label>
                    {{-- <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}"> --}}
                    <select name="jabatan_penerima" id="jabatan" class="form-control" required>
                        @if (Route::is('editserahterima'))
                            <option value="{{ $serahterima->jabatan_penerima }}">{{ $serahterima->jabatan_penerima }}</option>
                        @endif
                        @foreach ($jabatan as $jabatan)
                        <option value="{{ $jabatan->nama }}">{{ $jabatan->nama }}</option>
                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="divisi">Divisi Penerima</label>
                    {{-- <input type="text" name="divisi" class="form-control" value="{{ old('divisi') }}"> --}}
                    <select name="divisi_penerima" id="divisi" class="form-control" required>
                        @if (Route::is('editserahterima'))
                            <option value="{{ $serahterima->divisi_penerima }}">{{ $serahterima->divisi_penerima }}</option>
                        @endif
                        @foreach ($divisi as $divisi)
                        <option value="{{ $divisi->nama }}">{{ $divisi->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="signature">Tanda Tangan Penerima (maks. 2mb)</label>
                    <div>
                        <canvas id="canvas1" width="400" height="200" style="border: 1px solid black;"></canvas>
                        <a class="btn btn-sm btn-danger" onclick="clearCanvas('canvas1')">Clear Tanda Tangan 1</a>
                        <a class="btn btn-sm btn-primary" onclick="saveSignature('canvas1', 'signaturePreview1','ttd_penerima')">Save Tanda Tangan 1</a>
                        <img id="signaturePreview1" style="max-width: 200px; max-height: 100px;" alt="Preview Tanda Tangan 1">
                    </div>
                    <input type="file" name="ttd_penerima" id="ttd_penerima" class="form-control">
                    <small style="color: red">*jika sudah tanda tangan harap simpan dan upload</small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_asset">Nama Penyerah</label>
                    @if (Route::is('editserahterima'))
                    <input type="text" name="nama_penyerah" class="form-control" value="{{ $serahterima->nama_penyerah }}" required>
                    @else
                    <input type="text" name="nama_penyerah" class="form-control" value="" required>
                    @endif
                    
                    @if ($errors->has('nama_asset'))
                        <span class="text-danger">{{ $errors->first('nama_asset') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan Penyerah</label>
                    {{-- <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}"> --}}
                    <select name="jabatan_penyerah" id="jabatan" class="form-control" required>
                        @if (Route::is('editserahterima'))
                            <option value="{{ $serahterima->jabatan_penerima }}">{{ $serahterima->jabatan_penerima }}</option>
                        @endif
                        @foreach ($jabatan_penyerah as $jabatan)
                        <option value="{{ $jabatan->nama}}">{{ $jabatan->nama }}</option>
                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="divisi">Divisi Penyerah</label>
                    {{-- <input type="text" name="divisi" class="form-control" value="{{ old('divisi') }}"> --}}
                    <select name="divisi_penyerah" id="divisi" class="form-control" required>
                        @if (Route::is('editserahterima'))
                            <option value="{{ $serahterima->divisi_penyerah }}">{{ $serahterima->divisi_penyerah }}</option>
                        @endif
                        @foreach ($divisi_penyerah as $divisi)
                        <option value="{{ $divisi->nama }}">{{ $divisi->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="signature">Tanda Tangan Penyerah (require, maks. 2mb)</label>
                    <div>
                        <canvas id="canvas2" width="400" height="200" style="border: 1px solid black;"></canvas>
                        <a class="btn btn-sm btn-danger" onclick="clearCanvas('canvas2')">Clear Tanda Tangan 2</a>
                        <a class="btn btn-sm btn-primary" onclick="saveSignature('canvas2', 'signaturePreview2', 'ttd_penyerah')">Save Tanda Tangan 2</a>
                        <img id="signaturePreview2" style="max-width: 200px; max-height: 100px;" alt="Preview Tanda Tangan 1">
                    
                    </div>
                    <input type="file" name="ttd_penyerah" id="ttd_penyerah" class="form-control" required>
                    <small style="color: red">*jika sudah tanda tangan harap simpan dan upload</small>
                </div>
            </div>

        </div>
        <div class="form-group">
            <label for="foto">Foto (required, maks. 2mb)</label>
            <input type="file" name="foto" class="form-control" value="{{ old('foto') }}" required>
            @if ($errors->has('foto'))
                <span class="text-danger">{{ $errors->first('foto') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="kondisi">Kondisi</label>
            {{-- <input type="text" name="kondisi" class="form-control" value="{{ old('kondisi') }}"> --}}
            <select name="kondisi" id="kondisi" class="form-control" required>
                @if (Route::is('editserahterima'))
                <option value="{{ $serahterima->kondisi }}">{{ $serahterima->kondisi }}</option>
                @endif
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Hilang">Hilang</option>
                <option value="Baik Stock Asset">Baik Stock Asset</option>
                <option value="Baik Stock Asset">Rusak Stock Asset</option>
                <option value="Baik Stock Asset">Maintenance Stock Asset</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Tempat</label>
            @if (Route::is('editserahterima'))
            <textarea name="tempat" id="tempat" cols="10" class="form-control" placeholder="Tempat Serah Terima" required>{{ $serahterima->tempat }}</textarea>
            @else
            <textarea name="tempat" id="tempat" cols="10" class="form-control" placeholder="Tempat Serah Terima" required></textarea>
            @endif
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            @if (Route::is('editserahterima'))
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" placeholder="deskripsikan tentang kondisi barang(kerusakan, perlengkapan, dll)" required>{{ $serahterima->deskripsi }}</textarea>
            @else
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" placeholder="deskripsikan tentang kondisi barang(kerusakan, perlengkapan, dll)" required></textarea>
            @endif
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" name="" id="" value="<?php echo date('Y-m-d'); ?>" disabled>
            <small style="color: red">tanggal diatur secara otomatis</small>
        </div>
        <div class="form-group">
            <label for="foto">Bukti surat serah terima (jika ada)</label>
            <input type="file" name="bukti" class="form-control" value="{{ old('bukti') }}">
            @if ($errors->has('bukti'))
                <span class="text-danger">{{ $errors->first('bukti') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@include('admin.ttd1')
@endsection
