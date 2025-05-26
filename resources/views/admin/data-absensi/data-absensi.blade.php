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
            <form method="GET" action="{{ url('admin/data-absensi') }}" class="mb-3 d-flex align-items-end">
                <div class="form-group mr-2">
                    <label for="tanggal">Pilih Tanggal:</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                        value="{{ request('tanggal') }}" required>
                </div>

                <div class="form-group mr-2">
                    <button type="submit" class="btn btn-primary mt-4">
                        <i class="fa fa-search"></i> Tampilkan
                    </button>
                </div>
            </form>

            <!-- Form terpisah untuk rekap -->
            <form method="POST" action="{{ url('admin/rekap-absensi') }}"
                onsubmit="return confirm('Yakin ingin merekap absensi pada tanggal ini?')"
                class="mb-4 d-flex align-items-end">
                @csrf
                <input type="hidden" name="tanggal"
                    value="{{ request('tanggal') ?? \Carbon\Carbon::now()->toDateString() }}">
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-file-alt"></i> Rekap Absensi
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Guru</th>
                            <th>Waktu Hadir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataAbsensi as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($data->tanggal)->isToday() ? 'Hari ini' : $data->tanggal }}
                                </td>



                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->waktu_masuk ?? '-' }}</td>
                                <td>
                                    @if ($data->status == 'Hadir')
                                        <span class="badge badge-success">Hadir</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Hadir</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/absensi/detail/', $data->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            @php
                                $tanggalDipilih = request('tanggal');
                                $isToday = \Carbon\Carbon::parse($tanggalDipilih)->isToday();
                            @endphp
                            <tr>
                                <td colspan="6" class="text-center">
                                    Tidak ada data absensi untuk {{ $isToday ? 'hari ini' : $tanggalDipilih }}.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>


                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
