@extends('komponen.template-admin')

@section('title', 'Data Guru')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Data Guru</h3>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Daftar Guru</h2>
                <div class="nav navbar-right panel_toolbox">
                    <a href="#" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Guru</a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Mata Pelajaran</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ahmad Santoso</td>
                                <td>197812312020011001</td>
                                <td>Matematika</td>
                                <td>Laki-laki</td>
                                <td>Jl. Melati No. 5</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sri Wahyuni</td>
                                <td>198504052005042002</td>
                                <td>Bahasa Indonesia</td>
                                <td>Perempuan</td>
                                <td>Jl. Kenanga No. 8</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Budi Hartono</td>
                                <td>197905132010121003</td>
                                <td>IPA</td>
                                <td>Laki-laki</td>
                                <td>Jl. Mawar No. 12</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Lestari Dewi</td>
                                <td>198301292008122004</td>
                                <td>IPS</td>
                                <td>Perempuan</td>
                                <td>Jl. Anggrek No. 21</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
