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
    <form method="POST" action="{{ route('createserahterima') }}" enctype="multipart/form-data">
        @csrf
    <div class="form-group">
        <label for="dkasset">DK Asset</label>
        
        <select name="dkasset" id="dkasset" class="form-control">
            @foreach ($asset as $asset)
                
            <option value="{{ $asset->dkasset }}">{{ $asset->dkasset }}</option>
            @endforeach
        </select>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_asset">Nama Penerima</label>
                    <input type="text" name="nama_penerima" class="form-control" value="" required>
                    
                    @if ($errors->has('nama_asset'))
                        <span class="text-danger">{{ $errors->first('nama_asset') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan penerima</label>
                    {{-- <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}"> --}}
                    <select name="jabatan_penerima" id="jabatan" class="form-control">
                        @foreach ($jabatan as $jabatan)
                        <option value="{{ $jabatan->nama }}">{{ $jabatan->nama }}</option>
                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="divisi">Divisi Penerima</label>
                    {{-- <input type="text" name="divisi" class="form-control" value="{{ old('divisi') }}"> --}}
                    <select name="divisi_penerima" id="divisi" class="form-control">
                        @foreach ($divisi as $divisi)
                        <option value="{{ $divisi->nama }}">{{ $divisi->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="signature">Tanda Tangan Penerima (require maks. 2mb)</label>
                    <input type="file" name="ttd_penerima" class="form-control">
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
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_asset">Nama Penyerah</label>
                    <input type="text" name="nama_penyerah" class="form-control" value="" required>
                    
                    @if ($errors->has('nama_asset'))
                        <span class="text-danger">{{ $errors->first('nama_asset') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan Penyerah</label>
                    {{-- <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}"> --}}
                    <select name="jabatan_penyerah" id="jabatan" class="form-control">
                        @foreach ($jabatan_penyerah as $jabatan)
                        <option value="{{ $jabatan->nama}}">{{ $jabatan->nama }}</option>
                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="divisi">Divisi Penyerah</label>
                    {{-- <input type="text" name="divisi" class="form-control" value="{{ old('divisi') }}"> --}}
                    <select name="divisi_penyerah" id="divisi" class="form-control">
                        @foreach ($divisi_penyerah as $divisi)
                        <option value="{{ $divisi->nama }}">{{ $divisi->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="signature">Tanda Tangan Penyerah (require maks. 2mb)</label>
                    <input type="file" name="ttd_penyerah" class="form-control">
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
            <label for="deskripsi">Tempat</label>
            <textarea name="tempat" id="tempat" cols="10" class="form-control" placeholder="Tempat Serah Terima"></textarea>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" placeholder="deskripsikan tentang kondisi barang(kerusakan, perlengkapan, dll)"></textarea>
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
@endsection
