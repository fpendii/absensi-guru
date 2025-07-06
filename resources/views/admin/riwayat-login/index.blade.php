@extends('komponen.template-admin')

@section('title', 'Riwayat Login Admin') {{-- Ganti judul --}}

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Riwayat Login Admin</h3> {{-- Ganti judul --}}
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Riwayat Login</h2>
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

                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th> {{-- Kembali ke Nama Admin --}}
                                            <th>Alamat IP</th>
                                            <th>User Agent</th>
                                            <th>Waktu Login</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($riwayatLogin as $log)
                                        <tr>
                                            <td>{{ $log->id }}</td>
                                            <td>{{ $log->user->name ?? 'N/A' }}</td>
                                            <td>{{ $log->ip_address ?? '-' }}</td>
                                            <td>{{ $log->user_agent ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($log->waktu_login)->locale('id')->isoFormat('dddd, D MMMM YYYY [pukul] HH:mm:ss') }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada riwayat login untuk admin.</td>
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
    {{-- DataTables scripts (Pastikan path ke file asset Anda benar) --}}
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
                "order": [[ 4, "desc" ]], // Urutkan berdasarkan kolom waktu login (kolom ke-5, index 4) secara descending
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endsection
