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
                    <a href="{{ url('guru/rekap-absensi/export/excel') }}" class="btn btn-sm btn-success">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </a>
                    {{-- <a href="{{ url('guru.absensi.export.pdf') }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </a> --}}
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
                            @foreach ($dataAbsensiGuru as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $item->waktu_masuk }}</td>
                                    <td>
                                        @php
                                            switch (strtolower($item->status)) {
                                                case 'hadir':
                                                    $badge = 'success';
                                                    break;
                                                case 'izin':
                                                    $badge = 'primary';
                                                    break;
                                                case 'sakit':
                                                    $badge = 'warning';
                                                    break;
                                                case 'alfa':
                                                    $badge = 'danger';
                                                    break;
                                                default:
                                                    $badge = 'secondary';
                                            }
                                        @endphp
                                        <span class="badge badge-{{ $badge }}">{{ ucfirst($item->status) }}</span>
                                    </td>
                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
