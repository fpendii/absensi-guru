@extends('komponen.template-guru')

@section('title', 'Absensi Hari Ini')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Absensi Hari Ini</h3>
    </div>
</div>

<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Form Absensi</h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            @if ($absensiHariIni)
                <div class="alert alert-success">
                    Anda sudah melakukan absensi hari ini.
                </div>
            @else
                <form action="{{ url('guru/data-absensi/store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_guru" value="{{ $dataGuru->id }}">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{ $dataGuru->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" value="{{ \Carbon\Carbon::now()->format('d M Y') }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="text" class="form-control" name="waktu" value="{{ \Carbon\Carbon::now()->format('H:i:s') }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="hadir">Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Absen Sekarang
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
