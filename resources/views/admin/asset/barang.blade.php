@extends('admin.asset.core')
@section('content')
    <h1>Hi</h1>
    @foreach ($asset as $asset)
        {{ $asset->nama_asset }}
    @endforeach
@endsection
