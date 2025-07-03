@extends('komponen.template-admin')

@section('title', 'Lokasi Sekolah')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Lokasi Sekolah</h3>
    </div>
</div>

<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Ubah Lokasi Sekolah</h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            {{-- Tambahkan pesan sukses jika ada --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- Form untuk mengupdate lokasi sekolah --}}
            <form action="{{ url('admin/lokasi-sekolah/update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"
                        value="{{ $lokasi->nama_alamat }}" > {{-- Dibuat readonly karena tidak diupdate --}}
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="inputLatitude">Latitude</label>
                        {{-- Input manual untuk Latitude --}}
                        <input type="text" class="form-control" id="inputLatitude" name="latitude_manual"
                            value="{{ old('latitude', (string)($lokasi->sekolahLat ?? -6.200000)) }}"
                            placeholder="Masukkan Latitude">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="inputLongitude">Longitude</label>
                        {{-- Input manual untuk Longitude --}}
                        <input type="text" class="form-control" id="inputLongitude" name="longitude_manual"
                            value="{{ old('longitude', (string)($lokasi->sekolahLong ?? 106.816666)) }}"
                            placeholder="Masukkan Longitude">
                    </div>
                </div>

                <div id="map" style="height: 400px;" class="mb-3"></div>

                {{-- Nilai dari input manual atau peta akan disinkronkan ke sini --}}
                <input type="hidden" name="latitude" id="latitude_submit" value="{{ old('latitude', (string)($lokasi->sekolahLat ?? -6.200000)) }}">
                <input type="hidden" name="longitude" id="longitude_submit" value="{{ old('longitude', (string)($lokasi->sekolahLong ?? 106.816666)) }}">


                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Lokasi</button>
            </form>
        </div>
    </div>
</div>

---

### Skrip Leaflet (CSS & JS)

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // --- Elemen DOM ---
    const inputLatManual = document.getElementById("inputLatitude");
    const inputLongManual = document.getElementById("inputLongitude");
    const inputLatSubmit = document.getElementById("latitude_submit");
    const inputLongSubmit = document.getElementById("longitude_submit");

    // --- Inisialisasi Nilai Awal Peta dan Marker ---
    // Ambil nilai latitude dan longitude dari input manual (yang sudah terisi dari DB/default)
    let initialLat = parseFloat(inputLatManual.value);
    let initialLong = parseFloat(inputLongManual.value);

    // Pastikan nilai awal valid, jika tidak gunakan default fallback
    if (isNaN(initialLat) || isNaN(initialLong)) {
        initialLat = -6.200000;
        initialLong = 106.816666;
    }

    // Inisialisasi peta
    const map = L.map('map').setView([initialLat, initialLong], 13);

    // Tambahkan tile layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Tambahkan marker awal
    const marker = L.marker([initialLat, initialLong], { draggable: true }).addTo(map);

    // --- Fungsi Sinkronisasi Koordinat ---
    // Fungsi untuk memperbarui semua input dan marker
    function updateCoordinates(lat, long) {
        // Update input manual
        inputLatManual.value = lat.toFixed(7);
        inputLongManual.value = long.toFixed(7);

        // Update input hidden untuk submit form
        inputLatSubmit.value = lat.toFixed(7);
        inputLongSubmit.value = long.toFixed(7);

        // Pindahkan marker dan pusat peta (tanpa mengubah zoom unless specified)
        marker.setLatLng([lat, long]);
        map.setView([lat, long], map.getZoom()); // Pastikan peta juga bergeser
    }

    // --- Event Listeners ---

    // 1. Saat input manual diubah
    // Gunakan 'input' event untuk real-time update saat mengetik, atau 'change' untuk setelah selesai mengetik.
    // 'change' lebih disarankan untuk validasi.
    inputLatManual.addEventListener('change', function() {
        const newLat = parseFloat(this.value);
        const newLong = parseFloat(inputLongManual.value); // Ambil juga nilai longitude saat latitude diubah
        if (!isNaN(newLat) && !isNaN(newLong)) {
            updateCoordinates(newLat, newLong);
        } else {
            alert('Latitude atau Longitude yang dimasukkan tidak valid.');
            // Opsional: reset nilai input jika tidak valid
            this.value = initialLat.toFixed(7);
            inputLongManual.value = initialLong.toFixed(7);
        }
    });

    inputLongManual.addEventListener('change', function() {
        const newLat = parseFloat(inputLatManual.value); // Ambil juga nilai latitude saat longitude diubah
        const newLong = parseFloat(this.value);
        if (!isNaN(newLat) && !isNaN(newLong)) {
            updateCoordinates(newLat, newLong);
        } else {
            alert('Latitude atau Longitude yang dimasukkan tidak valid.');
            // Opsional: reset nilai input jika tidak valid
            this.value = initialLong.toFixed(7);
            inputLatManual.value = initialLat.toFixed(7);
        }
    });

    // 2. Saat marker digeser
    marker.on('dragend', function(e) {
        const latlng = marker.getLatLng();
        updateCoordinates(latlng.lat, latlng.lng);
    });

    // 3. Saat peta diklik
    map.on('click', function(e) {
        updateCoordinates(e.latlng.lat, e.latlng.lng);
    });

    // 4. Saat hasil geocoder dipilih
    L.Control.geocoder({
        defaultMarkGeocode: false
    })
    .on('markgeocode', function(e) {
        const latlng = e.geocode.center;
        updateCoordinates(latlng.lat, latlng.lng);
        map.setView(latlng, 16); // Zoom lebih dekat setelah pencarian
    })
    .addTo(map);
</script>
@endsection
