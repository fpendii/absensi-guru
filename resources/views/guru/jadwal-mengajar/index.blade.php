@extends('komponen.template-guru')

@section('title', 'Jadwal Mengajar Saya')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Jadwal Mengajar Saya</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Jadwal Anda <small>Jadwal mengajar yang ditugaskan kepada Anda</small></h2>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <p class="text-muted font-13 m-b-30">
                                    Berikut adalah semua jadwal mengajar yang ditugaskan kepada Anda.
                                </p>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Mata Pelajaran</th>
                                            <th>Hari</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>Ruangan/Kelas</th>
                                            <th>Aksi</th> {{-- Tetap ada kolom aksi walaupun kosong --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($schedules as $schedule)
                                        <tr>
                                            <td>{{ $schedule->mapel->nama_mapel ?? 'N/A' }}</td>
                                            <td>{{ $schedule->hari }}</td>
                                            <td>{{ substr($schedule->jam_mulai, 0, 5) }}</td>
                                            <td>{{ substr($schedule->jam_selesai, 0, 5) }}</td>
                                            <td>{{ $schedule->ruangan_kelas }}</td>
                                            <td>
                                                {{-- Tombol Edit dihilangkan untuk guru --}}
                                                {{-- <a href="{{ url('guru/jadwal-mengajar-saya/' . $schedule->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a> --}}
                                                {{-- Anda bisa menambahkan teks "Tidak ada aksi" atau mengosongkan saja --}}
                                                Tidak ada aksi
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Anda belum memiliki jadwal mengajar.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- DataTables scripts --}}
    <script src="{{ asset('admin-template/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin-template/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "order": [[ 1, "asc" ], [ 2, "asc" ]], // Urutkan berdasarkan Hari, lalu Waktu Mulai
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endsection
