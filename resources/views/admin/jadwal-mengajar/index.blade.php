@extends('komponen.template-admin')

@section('title', 'Daftar Jadwal Mengajar Guru')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Daftar Jadwal Mengajar Guru</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Jadwal Mengajar <small>Informasi lengkap jadwal guru</small></h2>
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
                                    Di sini Anda dapat melihat, mengubah, dan menghapus jadwal mengajar guru. Untuk menambah jadwal baru, klik tombol di bawah.
                                </p>

                                <a href="{{ url('admin/jadwal-mengajar/create') }}" class="btn btn-success mb-3">
                                    <i class="fa fa-plus"></i> Tambah Jadwal Baru
                                </a>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Guru</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Hari</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>Ruangan/Kelas</th> {{-- Tetap ini --}}
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($schedules as $schedule)
                                        <tr>
                                            <td>{{ $schedule->guru->nama ?? 'N/A' }}</td>
                                            <td>{{ $schedule->mapel->nama_mapel ?? 'N/A' }}</td>
                                            <td>{{ $schedule->hari }}</td>
                                            <td>{{ substr($schedule->jam_mulai, 0, 5) }}</td>
                                            <td>{{ substr($schedule->jam_selesai, 0, 5) }}</td>
                                            <td>{{ $schedule->ruangan_kelas }}</td> {{-- Menampilkan nama kelas yang tersimpan --}}
                                            <td>
                                                <a href="{{ url('admin/jadwal-mengajar/edit/' . $schedule->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                <form action="{{ url('admin/jadwal-mengajar/delete/' . $schedule->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini? Tindakan ini tidak dapat dibatalkan.')"><i class="fa fa-trash"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data jadwal mengajar.</td>
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
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endsection
