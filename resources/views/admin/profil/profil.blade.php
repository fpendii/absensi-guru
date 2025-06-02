@extends('komponen.template-admin')

@section('title', 'Profil Admin')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Edit Profil Admin</h3>
    </div>
</div>

<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Form Edit Profil</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Tampilkan error validasi --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

           <form action="{{ url('admin/profil/update') }}" method="POST">
    @csrf
    @method('POST')

    <div class="row">
        <div class="col-md-3 text-center">
            <img src="/img/profil.jpg" alt="Foto Admin" class="img-fluid rounded-circle" style="max-width: 300px;">
        </div>
        <div class="col-md-9">
            <table class="table table-bordered">
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" class="form-control" value="{{ old('email', $admin->email ?? '') }}" required></td>
                </tr>

                

                <!-- field password -->
                <tr>
                    <th>Password Baru</th>
                    <td><input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ganti"></td>
                </tr>
                <tr>
                    <th>Konfirmasi Password</th>
                    <td><input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru"></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
        </div>
    </div>
</form>

        </div>
    </div>
</div>
@endsection
