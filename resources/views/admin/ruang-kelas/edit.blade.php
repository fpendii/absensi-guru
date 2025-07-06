@extends('komponen.template-admin')

@section('title', 'Edit Ruang Kelas')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Ruang Kelas</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Formulir Edit Ruang Kelas <small>Ubah nama kelas</small></h2>
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
                    <form action="{{ url('admin/ruang-kelas/' . $ruang_kela->id) }}" method="POST" id="form-edit-ruangan" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT') {{-- Penting: Gunakan method PUT untuk operasi update --}}

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_kelas">Nama Kelas <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas', $ruang_kela->nama_kelas) }}" required="required" class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="Contoh: Kelas X-A">
                                @error('nama_kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="{{ url('admin/ruang-kelas') }}" class="btn btn-primary">Batal</a>
                                <button type="submit" class="btn btn-success">Update Ruang Kelas</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
