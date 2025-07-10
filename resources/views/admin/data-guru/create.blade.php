@extends('komponen.template-admin')

@section('title', 'Tambah Guru')

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Tambah Data Guru</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Form Tambah Guru</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="/admin/data-guru/store" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- Data User --}}
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <input type="hidden" name="role" value="guru">

                        {{-- Data Guru --}}
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>NUPTK</label>
                            <input type="text" name="nuptk" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="telepon" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <input type="text" name="mata_pelajaran" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="guru">Guru</option>
                                <option value="kepala_sekolah">Kepala Sekolah</option>
                        </div>

                        <div class="form-group">
                            <label>Status Pegawai</label>
                            <input type="text" name="status_pegawai" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/admin/data-guru" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
