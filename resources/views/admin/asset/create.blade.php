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
        haibos
    @csrf
    @endif
    @if (Route::is('tambahasset'))    
    <form method="POST" action="{{ route('tambahassetpost') }}" enctype="multipart/form-data">
    @csrf
    @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dkasset">DK Asset</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="dkasset" class="form-control" value="{{ $asset->dkasset }}" required>
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="dkasset" class="form-control" value="{{ old('dkasset') }}" required>
                    @endif
                    @if ($errors->has('dkasset'))
                        <span class="text-danger">{{ $errors->first('dkasset') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="nama_asset">Nama Asset</label>
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
                    <label for="merk">Merk</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="merk" class="form-control" value="{{ $asset->merk }}">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="merk" class="form-control" value="{{ old('merk') }}">
                    @endif
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    {{-- <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}"> --}}
                    <select name="kategori" id="kategori" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->kategori->id }}">{{ $asset->kategori->nama }}</option>
                        @endif
                        @foreach ($kategori as $kategori)
                            
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                        {{-- <option value="IT - Elektronik">IT - Elektronik</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Perlengkapan Kantor">Perlengkapan Kantor</option>
                        <option value="Peralatan Kantor">Peralatan Kantor</option>
                        <option value="Infrastuktur - Elektronik">Infrastuktur - Elektronik</option>
                        <option value="Alat Kantor - Elektronik">Alat Kantor - Elektronik</option>
                        <option value="Alat Teknisi">Alat Teknisi</option> --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="user">User</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="user" class="form-control" value="{{ $asset->user }}">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="user" class="form-control" value="{{ old('user') }}">
                    @endif
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    {{-- <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}"> --}}
                    <select name="jabatan" id="jabatan" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->jabatan->id }}">{{ $asset->jabatan->nama }}</option>
                        @endif
                        @foreach ($jabatan as $jabatan)
                        <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                            
                        @endforeach
                        {{-- <option value="Staff">Staff</option>
                        <option value="Direktur Utama">Direktur Utama</option>
                        <option value="Asisten Direktur Utama">Asisten Direktur Utama</option>
                        <option value="Direktur Operasional">Direktur Operasional</option>
                        <option value="Asisten Direktur Operasional">Asisten Direktur Operasional</option>
                        <option value="Direktur Finance">Direktur Finance</option>
                        <option value="Asisten Direktur Finance">Asisten Direktur Finance</option>
                        <option value="Head Unit">Head Unit</option>
                        <option value="Senior Manager">Senior Manager</option>
                        <option value="Manager">Manager</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="PIC">PIC</option>
                        <option value="Security">Security</option>
                        <option value="Teknisi">Teknisi</option> --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="divisi">Divisi</label>
                    {{-- <input type="text" name="divisi" class="form-control" value="{{ old('divisi') }}"> --}}
                    <select name="divisi" id="divisi" class="form-control">
                        @if (Route::is('editasset'))
                        <option value="{{ $asset->divisi->id }}">{{ $asset->divisi->nama }}</option>
                        @endif
                        @foreach ($divisi as $divisi)
                        <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                        @endforeach
                        {{-- <option value="Humas & Service">Humas & Service</option>
                        <option value="Operasional">Operasional</option>
                        <option value="Manufaktur">Manufaktur</option>
                        <option value="Ekspedisi">Ekspedisi</option>
                        <option value="Produksi">Produksi</option>
                        <option value="HRD">HRD</option>
                        <option value="Planner">Planner</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Business Development">Business Development</option>
                        <option value="Partnership & Support">Partnership & Support</option>
                        <option value="Finance">Finance</option>
                        <option value="Logistik">Logistik</option>
                        <option value="stokis">stokis</option>
                        <option value="Direktur">Direktur</option>
                        <option value="Head Unit">Head Unit</option>
                        <option value="Asset">Asset</option>
                        <option value="Admin">Admin</option>
                        <option value="Kemitraan">Kemitraan</option> --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="area">Area</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="area" class="form-control" value="{{ $asset->area }}">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="area" class="form-control" value="{{ old('area') }}">
                    @endif
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    @if (Route::is('editasset'))
                    <input type="text" name="lokasi" class="form-control" value="{{ $asset->lokasi }}">
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}">
                    @endif
                </div>

                <div class="form-group">
                    <label for="status_aktif">Status Aktif</label>
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
                    <label for="kondisi">Kondisi</label>
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
                    </select>
                </div>

                <div class="form-group">
                    <label for="QTY">QTY</label>
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
                    <label for="tanggal">Tanggal (required)</label>
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
                    <label for="signature">Signature (maks. 2mb)</label>
                    @if (Route::is('editasset'))
                    <input type="file" name="signature" class="form-control" value="{{ $asset->signature }}">
                    <img src="{{ asset('storage/signature_asset/'.$asset->signature) }}" width="200px" alt="" srcset="">
                    <br>
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="file" name="signature" class="form-control">
                    @endif
                    <small><a href="#" data-toggle="modal" data-target="#tutorial">klik disini untuk melihat cara membuat tanda tangan online</a></small>
                    <div class="modal fade" id="tutorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tutorial tanda tangan online</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        <li>pergi ke <a target="blank" href="https://www.signwell.com/online-signature/draw/">https://www.signwell.com/online-signature/draw/</a></li>
                                        <li>gambar tanda tangan</li>
                                        <li>save dan download (transparent mode on)</li>
                                        <li>upload ke database</li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    @if (Route::is('editasset'))
                    <input type="text" name="status" class="form-control" value="{{ $asset->status }}" required>
                    @endif
                    @if (Route::is('tambahasset'))
                    <input type="text" name="status" class="form-control" value="{{ old('status') }}" required>
                    @endif
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
