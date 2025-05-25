@extends('komponen.template-admin')

@section('title', 'Data Guru')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Data Guru</h3>
    </div>
</div>

<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Daftar Guru</h2>
            <div class="nav navbar-right panel_toolbox">
                <a href="{{ url('admin/data-guru/create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Guru</a>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Mata Pelajaran</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataGuru as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nip ?? '-' }}</td>
                                <td>{{ $item->mata_pelajaran ?? '-' }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->alamat ?? '-' }}</td>
                                <td>
                                    <a href="{{ url('admin/data-guru/edit/', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ url('admin/data-guru/delete/', $item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

@endsection
