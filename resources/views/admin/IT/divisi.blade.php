@extends('admin.core')

@section('content')
<div class="d-flex flex-row-reverse bd-highlight">
    <a class="btn-sm btn-primary ml-2" href="#" data-toggle="modal" data-target="#buat_divisi">Buat divisi</a>
</div>
<div class="modal fade" id="buat_divisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edd Item</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">                
                <form id="addform" action="{{ route('buatdivisi') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama : </label>
                        <input id="nama" type="text" class="form-control" name="nama" value="">
                        <label for="nama">Deskripsi : </label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                <a class="btn btn-primary" href="#"
                onclick="event.preventDefault();
                    document.getElementById('addform').submit();">
                    {{ __('Tambahkan') }}
                </a>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered mt-3">
<thead>
    <tr>
        <th>Nama</th>
        <th>Deskrpisi</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($divisi as $divisi)
    <tr>
        <td>{{ $divisi->nama }}</td>
        <td>{{ $divisi->deskripsi }}</td>
        <td>
            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#{{ Str::replace(array(' ','+'),'_',$divisi->nama) }}">Hapus</a>
            <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#{{ Str::replace(array(' ','+'),'_',$divisi->nama) }}{{ $divisi->id }}">Edit</a>
            
        </td>
    </tr>
    <div class="modal fade" id="{{ Str::replace(array(' ','+'),'_',$divisi->nama) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus item ini?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda ingin menghapus {{ $divisi->nama }} ini?, <b>semua data yang memiliki divisi "{{ $divisi->nama }}" akan terhapus semua secara otomatis setelah anda menekan tombol hapus</b></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <a class="btn btn-danger" href="#"
                    onclick="event.preventDefault();
                        document.getElementById('hapusform{{ $divisi->id }}').submit();">
                        {{ __('Hapus') }}
                    </a>
                    <form id="hapusform{{ $divisi->id }}" action="{{ route('hapusdivisi',$divisi->id) }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="{{ Str::replace(array(' ','+'),'_',$divisi->nama) }}{{ $divisi->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form id="editform{{ $divisi->id }}" action="{{ route('editdivisi',$divisi->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama : </label>
                            <input id="nama" type="text" class="form-control" name="nama" value="{{ $divisi->nama }}">
                            <label for="nama">Deskripsi : </label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $divisi->deskripsi }}</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <a class="btn btn-warning" href="#"
                    onclick="event.preventDefault();
                        document.getElementById('editform{{ $divisi->id }}').submit();">
                        {{ __('Edit') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</tbody>
</table>
@endsection