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
                    <td><a href="{{ route('showserahterima', $st->id) }}" class="btn btn-primary">Lihat</a></td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Render pagination links -->
        <div class="pagination-wrapper">
            @if ($st instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {!! $st->links('pagination::bootstrap-4') !!}
            @endif
        </div>
    </div>
@endsection
