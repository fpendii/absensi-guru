@extends('komponen.template-admin')

@section('title', 'Edit Jadwal Mengajar')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Jadwal Mengajar</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Formulir Edit Jadwal <small>Ubah detail jadwal mengajar</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-times"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{ url('admin/jadwal-mengajar/update/' . $jadwal_mengajar->id) }}" method="POST" id="form-edit-jadwal" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT')

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="id_guru">Guru <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control @error('id_guru') is-invalid @enderror" id="id_guru" name="id_guru" required>
                                    <option value="">Pilih Guru</option>
                                    @foreach($guru as $g)
                                        <option value="{{ $g->id }}" {{ (old('id_guru', $jadwal_mengajar->id_guru) == $g->id) ? 'selected' : '' }}>{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_guru')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="id_mapel">Mata Pelajaran <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control @error('id_mapel') is-invalid @enderror" id="id_mapel" name="id_mapel" required>
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach($mataPelajaran as $mapel)
                                        <option value="{{ $mapel->id }}" {{ (old('id_mapel', $jadwal_mengajar->id_mapel) == $mapel->id) ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                                    @endforeach
                                </select>
                                @error('id_mapel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="hari">Hari <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control @error('hari') is-invalid @enderror" id="hari" name="hari" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin" {{ (old('hari', $jadwal_mengajar->hari) == 'Senin') ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ (old('hari', $jadwal_mengajar->hari) == 'Selasa') ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ (old('hari', $jadwal_mengajar->hari) == 'Rabu') ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ (old('hari', $jadwal_mengajar->hari) == 'Kamis') ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ (old('hari', $jadwal_mengajar->hari) == 'Jumat') ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ (old('hari', $jadwal_mengajar->hari) == 'Sabtu') ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ (old('hari', $jadwal_mengajar->hari) == 'Minggu') ? 'selected' : '' }}>Minggu</option>
                                </select>
                                @error('hari')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="jam_mulai">Waktu Mulai <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', substr($jadwal_mengajar->jam_mulai, 0, 5)) }}" required="required" class="form-control @error('jam_mulai') is-invalid @enderror">
                                @error('jam_mulai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="jam_selesai">Waktu Selesai <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', substr($jadwal_mengajar->jam_selesai, 0, 5)) }}" required="required" class="form-control @error('jam_selesai') is-invalid @enderror">
                                @error('jam_selesai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Ganti input text ruangan_kelas dengan select dropdown --}}
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="id_ruang_kelas">Ruangan/Kelas <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control @error('id_ruang_kelas') is-invalid @enderror" id="id_ruang_kelas" name="id_ruang_kelas" required>
                                    <option value="">Pilih Ruangan/Kelas</option>
                                    @foreach($ruanganKelas as $ruangan)
                                        {{-- Logika untuk memilih ruang kelas yang sudah tersimpan --}}
                                        <option value="{{ $ruangan->id }}"
                                            {{ (old('id_ruang_kelas') == $ruangan->id || $jadwal_mengajar->ruangan_kelas == $ruangan->nama_kelas) ? 'selected' : '' }}>
                                            {{ $ruangan->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_ruang_kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="{{ url('admin/jadwal-mengajar') }}" class="btn btn-primary">Batal</a>
                                <button type="submit" class="btn btn-success">Update Jadwal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
