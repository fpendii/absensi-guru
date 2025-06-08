@extends('komponen.template-guru')

@section('title', 'Profil Guru')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Edit Profil Guru</h3>
    </div>
</div>

<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Form Edit Profil Guru</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('guru/profil/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="row">

                    <div class="col-md-9">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama</th>
                                <td><input type="text" name="nama" class="form-control" value="{{ $guru->nama }}" required></td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td><input type="text" name="nip" class="form-control" value="{{ $guru->nip }}"></td>
                            </tr>
                            <tr>
                                <th>NUPTK</th>
                                <td><input type="text" name="nuptk" class="form-control" value="{{ $guru->nuptk }}"></td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td><input type="text" name="telepon" class="form-control" value="{{ $guru->telepon }}"></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td><input type="text" name="tempat_lahir" class="form-control" value="{{ $guru->tempat_lahir }}"></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><textarea name="alamat" class="form-control">{{ $guru->alamat }}</textarea></td>
                            </tr>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <td><input type="text" name="mata_pelajaran" class="form-control" value="{{ $guru->mata_pelajaran }}"></td>
                            </tr>
                            <tr>
                                <th>Pendidikan Terakhir</th>
                                <td><input type="text" name="pendidikan_terakhir" class="form-control" value="{{ $guru->pendidikan_terakhir }}"></td>
                            </tr>
                            <tr>
                                <th>Status Pegawai</th>
                                <td><input type="text" name="status_pegawai" class="form-control" value="{{ $guru->status_pegawai }}"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Masuk</th>
                                <td><input type="date" name="tanggal_masuk" class="form-control" value="{{ $guru->tanggal_masuk }}"></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><input type="email" name="email" class="form-control" value="{{ $guru->email }}" required></td>
                            </tr>
                            <tr>
                                <th>Password Baru</th>
                                <td><input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti"></td>
                            </tr>
                            <tr>
                                <th>Konfirmasi Password</th>
                                <td><input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password"></td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
