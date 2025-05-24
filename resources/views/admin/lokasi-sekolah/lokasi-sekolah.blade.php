@extends('komponen.template-admin')

@section('title', 'Lokasi Sekolah')

@section('content')
<!-- Page title -->
<div class="page-title">
    <div class="title_left">
        <h3>Lokasi Sekolah</h3>
    </div>
</div>

<!-- Panel -->
<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Ubah Lokasi Sekolah</h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form action="#" method="POST">
                @csrf
                <!-- Alamat -->
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"
                        value="Jl. Pendidikan No.123, Kota Contoh" required>
                </div>

                <!-- Map -->
                <div id="map" style="height: 400px;" class="mb-3"></div>

                <!-- Latitude & Longitude -->
                <input type="hidden" name="latitude" id="latitude" value="-6.200000">
                <input type="hidden" name="longitude" id="longitude" value="106.816666">

                <!-- Submit -->
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Lokasi</button>
            </form>
        </div>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Leaflet Control Geocoder Plugin -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // Inisialisasi peta
    var map = L.map('map').setView([-6.200000, 106.816666], 13);

    // Tambahkan tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker awal
    var marker = L.marker([-6.200000, 106.816666], { draggable: true }).addTo(map);

    // Update input saat marker dipindah
    marker.on('dragend', function(e) {
        var latlng = marker.getLatLng();
        document.getElementById("latitude").value = latlng.lat;
        document.getElementById("longitude").value = latlng.lng;
    });

    // Update marker saat peta diklik
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById("latitude").value = e.latlng.lat;
        document.getElementById("longitude").value = e.latlng.lng;
    });

    // Tambahkan fitur pencarian lokasi
    L.Control.geocoder({
        defaultMarkGeocode: false
    })
    .on('markgeocode', function(e) {
        var latlng = e.geocode.center;
        marker.setLatLng(latlng);
        map.setView(latlng, 16);
        document.getElementById("latitude").value = latlng.lat;
        document.getElementById("longitude").value = latlng.lng;
    })
    .addTo(map);
</script>
@endsection
