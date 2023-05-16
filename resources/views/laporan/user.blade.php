@extends('laporan.master')

@section('konten')
    <div class="row mb-3">
        <div class="col-lg-3">
            <button class="btn btn-md btn-primary btn-block font-weight-bold">USER</button>
        </div>
        <div class="col-lg-3">
            <button class="btn btn-md btn-success btn-block font-weight-bold">TRANSAKSI</button>
        </div>
        <div class="col-lg-3">
            <button class="btn btn-md btn-warning btn-block font-weight-bold">FASILITAS</button>
        </div>
        <div class="col-lg-3">
            <button class="btn btn-md btn-danger btn-block font-weight-bold">ACARA</button>
        </div>
    </div>

    <table id="tabel-laporan-user" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th style="width: 5%">#</th>
                <th style="width: 45%">NAMA</th>
                <th style="width: 45%">ROLE</th>
                <th style="width: 5%">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $u)
                <tr>
                    <td>{{ $u->user_id }}</td>
                    <td>{{ $u->user_nama }}</td>
                    <td>{{ $u->user_role }}</td>
                    <td>
                        <button class="btn btn-sm btn-danger font-weight-bold">HAPUS</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#tabel-laporan-user').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
