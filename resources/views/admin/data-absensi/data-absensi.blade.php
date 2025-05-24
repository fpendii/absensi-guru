@extends('komponen.template-admin')

@section('title', 'Absensi Guru')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Absensi Guru</h3>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Daftar Absensi</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Guru</th>
                                <th>Waktu Hadir</th>
                                <th>Status</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2025-05-25</td>
                                <td>Ahmad Santoso</td>
                                <td>07:01:23</td>
                                <td><span class="badge badge-success">Hadir</span></td>
                                <td>Di Sekolah</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2025-05-25</td>
                                <td>Sri Wahyuni</td>
                                <td>07:10:45</td>
                                <td><span class="badge badge-success">Hadir</span></td>
                                <td>Di Sekolah</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2025-05-25</td>
                                <td>Budi Hartono</td>
                                <td>-</td>
                                <td><span class="badge badge-danger">Tidak Hadir</span></td>
                                <td>-</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>2025-05-25</td>
                                <td>Lestari Dewi</td>
                                <td>07:05:12</td>
                                <td><span class="badge badge-success">Hadir</span></td>
                                <td>Di Sekolah</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
