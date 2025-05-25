@extends('komponen.template-admin')

@section('title', 'Edit Guru')

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Data Guru</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Form Edit Guru</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="{{ url('/admin/data-guru/update/' . $guru->id ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Data User --}}
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ $guru->user->email }}" required>
                        </div>

                        <div class="form-group">
                            <label>Password Baru (opsional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                        </div>

                        {{-- Data Guru --}}
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ $guru->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="{{ $guru->nip }}">
                        </div>

                        <div class="form-group">
                            <label>NUPTK</label>
                            <input type="text" name="nuptk" class="form-control" value="{{ $guru->nuptk }}">
                        </div>

                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="telepon" class="form-control" value="{{ $guru->telepon }}">
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $guru->tempat_lahir }}">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $guru->tanggal_lahir }}">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ $guru->alamat }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Foto (biarkan kosong jika tidak ingin diganti)</label>
                            <input type="file" name="foto" class="form-control-file">
                            @if($guru->foto)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" width="100">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <input type="text" name="mata_pelajaran" class="form-control" value="{{ $guru->mata_pelajaran }}">
                        </div>

                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" class="form-control" value="{{ $guru->pendidikan_terakhir }}">
                        </div>

                        <div class="form-group">
                            <label>Status Pegawai</label>
                            <input type="text" name="status_pegawai" class="form-control" value="{{ $guru->status_pegawai }}">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="{{ $guru->tanggal_masuk }}">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="/admin/data-guru" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
