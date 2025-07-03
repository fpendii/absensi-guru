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
                {{-- Menampilkan pesan sukses atau error dari Controller --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($absensiHariIni)
                    <div class="alert alert-success">
                        Anda sudah melakukan absensi hari ini.
                    </div>
                @else
                    <form action="{{ url('guru/absensi/store') }}" method="POST">
                        @csrf
                        {{-- ID Guru diambil dari data guru yang login --}}
                        <input type="hidden" name="id_guru" value="{{ $dataGuru->id }}">
                        {{-- Input tersembunyi untuk menyimpan lokasi pengguna yang akan disubmit --}}
                        <input type="hidden" name="latitude" id="latitude_user">
                        <input type="hidden" name="longitude" id="longitude_user">

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $dataGuru->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            {{-- Menggunakan objek Carbon yang dikirim dari controller --}}
                            <input type="text" class="form-control" name="tanggal"
                                value="{{ $now->format('Y-m-d') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Waktu</label>
                            {{-- Menggunakan objek Carbon yang dikirim dari controller --}}
                            <input type="text" class="form-control" name="waktu"
                                value="{{ $now->format('H:i:s') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="status_absensi" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                            </select>
                        </div>
                        <div class="form-group" id="keterangan_field" style="display: none;">
                            <label for="keterangan">Keterangan (Opsional)</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                        </div>

                        <hr>
                        <h4>Informasi Lokasi Absensi</h4>
                        <p>Lokasi Sekolah: <span id="sekolah_coords">Mengambil...</span></p>
                        <p>Lokasi Anda: <span id="user_coords">Mengambil...</span></p>
                        <div id="map_absensi" style="height: 300px; border-radius: 5px;" class="mb-3"></div>
                        <p class="text-muted"><small>Marker hijau adalah lokasi sekolah. Marker biru adalah lokasi Anda saat ini. Lingkaran biru menunjukkan radius absensi yang diizinkan.</small></p>

                        <button type="submit" class="btn btn-success" id="submit_button" disabled>
                            <i class="fa fa-check"></i> Absen Sekarang
                        </button>
                    </form>

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
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Link CSS dan JS untuk Leaflet --}}
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                    {{-- jQuery (pastikan ini sudah dimuat atau gunakan Vanilla JS jika tidak pakai jQuery) --}}
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                    {{-- Script Geolocation dan Peta --}}
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // --- Ambil data lokasi sekolah dari PHP (Controller) ---
                            // Pastikan konversi ke float karena dari DB bisa berupa string (VARCHAR)
                            const sekolahLat = parseFloat("{{ (string)$lokasiSekolah->sekolahLat }}");
                            const sekolahLong = parseFloat("{{ (string)$lokasiSekolah->sekolahLong }}");
                            const radiusMaks = parseInt("{{ $lokasiSekolah->radius }}"); // Radius dalam meter

                            // Tampilkan koordinat sekolah di UI
                            document.getElementById('sekolah_coords').textContent = `Lat: ${sekolahLat.toFixed(7)}, Long: ${sekolahLong.toFixed(7)}`;

                            // --- Inisialisasi Peta Leaflet ---
                            // Pusat peta awal di lokasi sekolah
                            const mapAbsensi = L.map('map_absensi').setView([sekolahLat, sekolahLong], 15);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(mapAbsensi);

                            // Marker untuk lokasi sekolah (Hijau)
                            const schoolIcon = new L.Icon({
                                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            });
                            L.marker([sekolahLat, sekolahLong], { icon: schoolIcon }).addTo(mapAbsensi)
                                .bindPopup("<b>Lokasi Sekolah</b><br>Radius Absensi: " + radiusMaks + " meter").openPopup();

                            // Lingkaran radius di sekitar lokasi sekolah
                            L.circle([sekolahLat, sekolahLong], {
                                color: 'blue',
                                fillColor: '#3388ff',
                                fillOpacity: 0.1,
                                radius: radiusMaks // Radius diambil dari database
                            }).addTo(mapAbsensi);

                            // Marker untuk lokasi pengguna (Biru)
                            const userIcon = new L.Icon({
                                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            });
                            let userMarker = null; // Akan dibuat setelah lokasi user ditemukan

                            // --- Geolocation API ---
                            const submitButton = document.getElementById("submit_button");
                            const latitudeUser = document.getElementById('latitude_user');
                            const longitudeUser = document.getElementById('longitude_user');
                            const userCoordsSpan = document.getElementById('user_coords');
                            const statusSelect = document.getElementById('status_absensi');
                            const keteranganField = document.getElementById('keterangan_field');

                            // Tampilkan/sembunyikan field keterangan berdasarkan status
                            statusSelect.addEventListener('change', function() {
                                if (this.value === 'izin' || this.value === 'sakit') {
                                    keteranganField.style.display = 'block';
                                    keteranganField.querySelector('textarea').setAttribute('required', 'required'); // Keterangan wajib jika izin/sakit
                                } else {
                                    keteranganField.style.display = 'none';
                                    keteranganField.querySelector('textarea').removeAttribute('required');
                                    keteranganField.querySelector('textarea').value = ''; // Kosongkan jika hadir
                                }

                                // Re-check validasi lokasi saat status berubah
                                if (latitudeUser.value && longitudeUser.value) { // Pastikan lokasi sudah didapat
                                    checkLocationValidity(parseFloat(latitudeUser.value), parseFloat(longitudeUser.value));
                                }
                            });

                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {
                                    enableHighAccuracy: true, // Mencoba mendapatkan lokasi seakurat mungkin
                                    timeout: 10000, // Batas waktu 10 detik
                                    maximumAge: 0 // Tidak menggunakan cache lokasi lama
                                });
                            } else {
                                tampilkanModal("Browser Anda tidak mendukung Geolocation atau GPS.");
                                submitButton.disabled = true; // Nonaktifkan tombol submit
                                userCoordsSpan.textContent = `Tidak tersedia.`;
                            }

                            function successCallback(position) {
                                const userLat = position.coords.latitude;
                                const userLng = position.coords.longitude;

                                // Simpan lokasi pengguna ke input hidden
                                latitudeUser.value = userLat;
                                longitudeUser.value = userLng;
                                userCoordsSpan.textContent = `Lat: ${userLat.toFixed(7)}, Long: ${userLng.toFixed(7)}`;

                                // Tambahkan atau update marker user di peta
                                if (userMarker) {
                                    userMarker.setLatLng([userLat, userLng]);
                                } else {
                                    userMarker = L.marker([userLat, userLng], { icon: userIcon }).addTo(mapAbsensi)
                                        .bindPopup("<b>Lokasi Anda Saat Ini</b>").openPopup();
                                }
                                mapAbsensi.setView([userLat, userLng], 15); // Pusatkan peta ke lokasi user

                                // Lakukan validasi lokasi dan aktifkan/nonaktifkan tombol submit
                                checkLocationValidity(userLat, userLng);
                            }

                            function errorCallback(error) {
                                let pesanError = "Gagal mendapatkan lokasi Anda. ";
                                switch (error.code) {
                                    case error.PERMISSION_DENIED:
                                        pesanError += "Anda menolak izin lokasi. Absensi mungkin memerlukan lokasi Anda.";
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        pesanError += "Informasi lokasi tidak tersedia. Coba aktifkan GPS atau periksa koneksi internet.";
                                        break;
                                    case error.TIMEOUT:
                                        pesanError += "Permintaan lokasi habis waktu. Pastikan sinyal GPS stabil.";
                                        break;
                                    case error.UNKNOWN_ERROR:
                                        pesanError += "Terjadi kesalahan yang tidak diketahui.";
                                        break;
                                }
                                tampilkanModal(pesanError + " Silakan coba lagi atau pilih status Izin/Sakit.");
                                submitButton.disabled = true; // Nonaktifkan tombol submit
                                userCoordsSpan.textContent = `Gagal mendapatkan lokasi.`;
                            }

                            // Fungsi untuk memeriksa validitas lokasi (di sisi frontend)
                            function checkLocationValidity(userLat, userLng) {
                                const distance = hitungJarak(userLat, userLng, sekolahLat, sekolahLong);
                                const currentStatus = statusSelect.value;

                                if (currentStatus === 'hadir' && distance > radiusMaks) {
                                    tampilkanModal(`Anda (${distance.toFixed(2)} meter) berada di luar radius absensi (${radiusMaks} meter) yang diperbolehkan untuk HADIR.`);
                                    submitButton.disabled = true;
                                } else {
                                    submitButton.disabled = false;
                                }
                            }

                            // Fungsi hitung jarak Haversine (untuk validasi frontend)
                            function hitungJarak(lat1, lon1, lat2, lon2) {
                                const R = 6371e3; // Radius bumi dalam meter
                                const φ1 = lat1 * Math.PI / 180;
                                const φ2 = lat2 * Math.PI / 180;
                                const Δφ = (lat2 - lat1) * Math.PI / 180;
                                const Δλ = (lon2 - lon1) * Math.PI / 180;

                                const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                                        Math.cos(φ1) * Math.cos(φ2) *
                                        Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
                                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

                                return R * c; // Jarak dalam meter
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
