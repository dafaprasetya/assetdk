@extends('admin.core')
@section('content')

    {{-- <h1>Hi</h1>
    @foreach ($asset as $asset)
        {{ $asset->nama_asset }}
    @endforeach --}}
    <div class="checksound">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Database Serah Terima</h6>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-row-reverse bd-highlight">
                            @if ($search)
                            <a class="btn-sm btn-danger ml-2" target="blank" href="{{ route('cetak') }}">cetak semua</a>
                            <a class="btn-sm btn-primary" target="blank" href="{{ route('cetak') }}?search={{ $search }}">cetak hasil dari pencarian {{ $search }}</a>            
                            @else
                            <a class="btn-sm btn-danger" target="blank" href="{{ route('cetak') }}">cetak semua</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>DKASSET</th>
                                <th>Waktu</th>
                                <th>Nama Penerima</th>
                                <th>Divisi Penerima</th>
                                <th>Nama Peyerah</th>
                                <th>Divisi Peyerah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($st as $st)
                            <tr>
                                <td>{{ $st->dkasset }}</td>
                                <td>{{ $st->waktu }}</td>
                                <td>{{ $st->nama_penerima }}</td>
                                <td>{{ $st->divisi_penerima }}</td>
                                <td>{{ $st->nama_penyerah }}</td>
                                <td>{{ $st->divisi_penyerah}}</td>
                                <td>
                                    <a href="{{ route('showserahterima', $st->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                                    <a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="{{ '#'.$st->dkasset }}">Hapus</a>
                                    <a class="btn btn-sm btn-warning" href="{{ route('editserahterima', $st->id) }}">Edit</a>
                                </td>
                                <div class="modal fade" id="{{ $st->dkasset }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus item ini?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Apakah anda ingin menghapus ni?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                                                    <a class="btn btn-primary" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                        document.getElementById('hapusform').submit();">
                                                        {{ __('Hapus') }}
                                                    </a>
                                                    <form id="hapusform" action="{{ route('deleteserahterima', $st->id) }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        
                <!-- Render pagination links -->
                <div class="pagination-wrapper">
                    @if ($st instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {!! $st->links('pagination::bootstrap-4') !!}
                    @endif
                </div>
            </div>
        </div>
        <!-- Table data with pagination will be injected here -->
    </div>
@endsection
