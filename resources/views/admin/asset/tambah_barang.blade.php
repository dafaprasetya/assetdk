@extends('admin.asset.core')

@section('content')
{{ $title }}

<form action="{{route('tambahassetpost')}}" method="post">
@csrf
<input type="text" name="idbarang" id="" placeholder="masukan id barang">
<br>
<input type="text" name="nama" id="" placeholder="masukan nama barang">
<br>
<select name="kategori" id="">
    <option value="">Pilih kategori</option>
    @foreach ($kategori as $kategori)

    <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
    @endforeach
</select>
<br>
<select name="milik" id="">
    <option value="">Milik</option>
    <option value="kantor">kantor</option>
    <option value="sewa">sewa</option>
</select>
<br>
<input type="text" name="nama_pemegang" id="" placeholder="Masukan Nama Pemegang Asset (Sekarang)">
<br>
<input type="text" name="nik_pemegang" id="" placeholder="Masukan NIK Pemegang Asset (Sekarang)">
<br>
<input type="text" name="divisi_pemegang" id="" placeholder="Masukan Divisi Pemegang Asset (Sekarang)">
<br>
<select name="kondisi" id="">
    <option value="">kondisi barang</option>
    <option value="baik">baik</option>
    <option value="rusak">rusak</option>
</select>
<br>
<textarea name="deskripsi" id="" cols="30" rows="10">deskripsi barang</textarea>
<br>

<button type="submit">input</button>
</form>

@endsection
