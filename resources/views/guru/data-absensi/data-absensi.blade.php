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
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $dataGuru->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" class="form-control" name="tanggal"
                                value="{{ \Carbon\Carbon::now()->format('d M Y') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Waktu</label>
                            <input type="text" class="form-control" name="waktu"
                                value="{{ \Carbon\Carbon::now()->format('H:i:s') }}" readonly>
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

                    <!-- Modal Bootstrap -->
                    <div class="modal fade" id="lokasiModal" tabindex="-1" role="dialog" aria-labelledby="lokasiModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="lokasiModalLabel">Peringatan Lokasi</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Pesan akan diubah oleh JavaScript -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Script Geolocation -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
                            } else {
                                tampilkanModal("Browser Anda tidak mendukung Geolocation.");
                                document.querySelector("button[type='submit']").disabled = true;
                            }

                            function successCallback(position) {
                                const userLat = position.coords.latitude;
                                const userLng = position.coords.longitude;

                                const sekolahLat = -3.8036268;
                                const sekolahLng = 114.7658191;
                                const radiusMaks = 100; // meter

                                const distance = hitungJarak(userLat, userLng, sekolahLat, sekolahLng);

                                if (distance > radiusMaks) {
                                    tampilkanModal("Anda berada di luar radius absensi yang diperbolehkan.");
                                    document.querySelector("button[type='submit']").disabled = true;
                                } else {
                                    document.getElementById('latitude').value = userLat;
                                    document.getElementById('longitude').value = userLng;
                                }
                            }

                            function errorCallback(error) {
                                tampilkanModal("Gagal mendapatkan lokasi. Aktifkan GPS Anda.");
                                document.querySelector("button[type='submit']").disabled = true;
                            }

                            function hitungJarak(lat1, lon1, lat2, lon2) {
                                const R = 6371e3; // meters
                                const φ1 = lat1 * Math.PI / 180;
                                const φ2 = lat2 * Math.PI / 180;
                                const Δφ = (lat2 - lat1) * Math.PI / 180;
                                const Δλ = (lon2 - lon1) * Math.PI / 180;

                                const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                                    Math.cos(φ1) * Math.cos(φ2) *
                                    Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
                                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

                                return R * c;
                            }

                            function tampilkanModal(pesan) {
                                $('#lokasiModal .modal-body').text(pesan);
                                $('#lokasiModal').modal('show');
                            }
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>
@endsection
