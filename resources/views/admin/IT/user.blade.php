@extends('admin.core')

@section('content')
<div class="d-flex flex-row-reverse bd-highlight">
    <a class="btn-sm btn-primary ml-2" href="#" data-toggle="modal" data-target="#buat_divisi">Buat divisi</a>
</div>
<div class="modal fade" id="buat_divisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}" id="registeruser">
                    @csrf

                    <div class="row mb-3">
                        <label for="nik" class="col-md-4 col-form-label text-md-end">{{ __('NIK') }}</label>

                        <div class="col-md-6">
                            <input id="nik" type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="divisi" class="col-md-4 col-form-label text-md-end">{{ __('Divisi') }}</label>

                        <div class="col-md-6">
                            {{-- <input id="divisi" type="text" class="form-control @error('divisi') is-invalid @enderror" name="divisi" value="{{ old('divisi') }}" required autocomplete="divisi" autofocus> --}}
                            <select name="divisi" id="divisi" class="form-control">
                                @foreach ($divisi as $divisi)
                                    <option value="{{ $divisi->nama }}">{{ $divisi->nama }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                <a class="btn btn-primary" href="#"
                onclick="event.preventDefault();
                    document.getElementById('registeruser').submit();">
                    {{ __('Tambahkan') }}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">

    <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Divisi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $user)
        <tr>
            <td>{{ $user->nik }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->divisi }}</td>
            <td>
                @if (Auth::user()->nik == $user->nik)
                    Current User
                @else
                    
                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#{{ Str::replace(array(' ','+'),'_',$user->nama) }}">Hapus</a>
                <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#{{ Str::replace(array(' ','+'),'_',$user->nama) }}{{ $user->id }}">Edit</a>
                @endif
                
            </td>
        </tr>
        <div class="modal fade" id="{{ Str::replace(array(' ','+'),'_',$user->nama) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus item ini?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Apakah anda ingin menghapus {{ $user->nama }} ini?, <b>semua data yang memiliki divisi "{{ $user->nama }}" akan terhapus semua secara otomatis setelah anda menekan tombol hapus</b></div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    
                        <a class="btn btn-danger" href="#"
                        onclick="event.preventDefault();
                            document.getElementById('hapusform{{ $user->nik }}').submit();">
                            {{ __('Hapus') }}
                        </a>
                        <form id="hapusform{{ $user->nik }}" action="{{ route('hapususer',$user->nik) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="{{ Str::replace(array(' ','+'),'_',$user->nama) }}{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        
                        <form id="editform{{ $user->nik }}" action="{{ route('edituser',$user->nik) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nik">NIK : </label>
                                <input id="nik" type="text" class="form-control" name="nik" value="{{ $user->nik }}">
                                <label for="nama">Nama : </label>
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $user->nama }}">
                                <label for="email">Email : </label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                                <label for="nama">Password baru : </label>
                                <input id="password" type="email" class="form-control" name="password" placeholder="masukan password baru">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    
                        <a class="btn btn-warning" href="#"
                        onclick="event.preventDefault();
                            document.getElementById('editform{{ $user->nik }}').submit();">
                            {{ __('Edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
    </table>
</div>
@endsection