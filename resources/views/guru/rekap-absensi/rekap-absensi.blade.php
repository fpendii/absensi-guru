@extends('komponen.template-guru')

@section('title', 'Rekap Absensi Pribadi')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Rekap Absensi Pribadi</h3>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Absensi Anda</h2>
                <div class="nav navbar-right panel_toolbox">
                    <a href="{{ url('guru.absensi.export.excel') }}" class="btn btn-sm btn-success">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </a>
                    <a href="{{ url('guru.absensi.export.pdf') }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Contoh data, ganti dengan @foreach --}}
                            <tr>
                                <td>1</td>
                                <td>2025-05-20</td>
                                <td>07:04:22</td>
                                <td><span class="badge badge-success">Hadir</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2025-05-21</td>
                                <td>07:02:11</td>
                                <td><span class="badge badge-success">Hadir</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2025-05-22</td>
                                <td>07:15:33</td>
                                <td><span class="badge badge-warning">Izin</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>2025-05-23</td>
                                <td>07:18:44</td>
                                <td><span class="badge badge-danger">Sakit</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>2025-05-24</td>
                                <td>07:06:05</td>
                                <td><span class="badge badge-success">Hadir</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
