@extends('komponen.template-admin')

@section('title', 'Profil Admin')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Profil Admin</h3>
    </div>
</div>

<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Informasi Profil</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="/img/profil.jpg" alt="Foto Admin" class="img-fluid rounded-circle" style="max-width: 300px;">
                </div>
                <div class="col-md-9">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td>Admin Sekolah</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>admin@sekolah.id</td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>081234567890</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>Jl. Pendidikan No. 123</td>
                        </tr>
                    </table>
                    <a href="{{ url('admin.profil.edit') }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
