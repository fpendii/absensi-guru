@extends('komponen.template-admin')

@section('title', 'Edit Mata Pelajaran')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Mata Pelajaran</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Formulir Edit Mata Pelajaran <small>Ubah nama mata pelajaran</small></h2>
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
                    {{-- Ganti route() dengan url() dan tambahkan ID --}}
                    <form action="{{ url('admin/mata-pelajaran/' . $mata_pelajaran->id) }}" method="POST" id="form-edit-mapel" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT') {{-- @method('PUT') ini tetap WAJIB untuk operasi update --}}

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_mapel">Nama Mata Pelajaran <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="nama_mapel" name="nama_mapel" value="{{ old('nama_mapel', $mata_pelajaran->nama_mapel) }}" required="required" class="form-control @error('nama_mapel') is-invalid @enderror" placeholder="Contoh: Matematika">
                                @error('nama_mapel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="{{ url('admin/mata-pelajaran') }}" class="btn btn-primary">Batal</a> {{-- Juga ganti di sini --}}
                                <button type="submit" class="btn btn-success">Update Mata Pelajaran</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
