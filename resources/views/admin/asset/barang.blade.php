@extends('admin.core')
@section('content')

    {{-- <h1>Hi</h1>
    @foreach ($asset as $asset)
        {{ $asset->nama_asset }}
    @endforeach --}}
    <div class="checksound">
        <!-- Table data with pagination will be injected here -->
        <div class="d-flex flex-row-reverse bd-highlight">
            @if ($search)
            <a class="btn-sm btn-danger ml-2" target="blank" href="{{ route('cetak') }}">cetak semua</a>
            <a class="btn-sm btn-primary" target="blank" href="{{ route('cetak') }}?search={{ $search }}">cetak hasil dari pencarian {{ $search }}</a>            
            @else
            <a class="btn-sm btn-danger" target="blank" href="{{ route('cetak') }}">cetak semua</a>
            @endif
        </div>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>QR</th>
                    <th>Merk</th>
                    <th>Kategori</th>
                    <th>User</th>
                    <th>Divisi</th>
                    <th>Lokasi</th>
                    <th>Kondisi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asset as $barang)
                <tr>
                    <td class="text-center">
                        {!! QrCode::size(90)->generate(route('detailasset',$barang->dkasset)); !!}
                        <p>{{ $barang->dkasset }}</p>
                    </td>
                    <td>{{ $barang->merk }}</td>
                    <td>{{ $barang->kategori->nama }}</td>
                    <td>{{ $barang->user }}</td>
                    <td>{{ $barang->divisi->nama }}</td>
                    <td>{{ $barang->lokasi }}</td>
                    <td>{{ $barang->kondisi }}</td>
                    <td>
                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </a>
                          
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              {{-- <a class="dropdown-item" target="blank" href="{{ route('detailasset', $barang->dkasset) }}">Cetak</a> --}}
                              <a class="dropdown-item" target="blank" href="{{ route('detailasset', $barang->dkasset) }}">Detail</a>
                              <a class="dropdown-item" href="{{ route('editasset',$barang->dkasset) }}">Edit</a>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="{{ '#'.$barang->dkasset }}">Hapus</a>
                              
                            </div>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="{{ $barang->dkasset }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus item ini?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Apakah anda ingin menghapus {{ $barang->dkasset }} ini?</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                <a class="btn btn-primary" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('hapusform').submit();">
                                    {{ __('Hapus') }}
                                </a>
                                <form id="hapusform" action="{{ route('hapusasset', $barang->dkasset) }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>

        <!-- Render pagination links -->
        <div class="pagination-wrapper">
            @if ($asset instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {!! $asset->links('pagination::bootstrap-4') !!}
            @endif
        </div>
    </div>
@endsection
